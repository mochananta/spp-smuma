<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\TransaksiMidtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class SnapController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function bayar(Request $request)
    {
        //membuat token pembayaran midtrans dari tagihan yang dipilih dan menyimpan ke database
        $tagihan_ids = $request->tagihan_ids;
        $total = Tagihan::whereIn('id', $tagihan_ids)->sum('nominal');

        $order_id = 'ORDER-' . time() . '-' . rand(1000, 9999);

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        TransaksiMidtrans::create([
            'user_id' => auth()->id(),
            'order_id' => $order_id,
            'gross_amount' => $total,
            'status' => 'pending',
            'snap_token' => $snapToken,
            'tagihan_ids' => json_encode($request->tagihan_ids),
        ]);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Verifikasi signature
        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        //

        // Ambil transaksi
        $transaksi = TransaksiMidtrans::where('order_id', $request->order_id)->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update status di database berdasarkan status dari Midtrans
        $transaksi->status = $request->transaction_status;
        $transaksi->save();

        // Jika status transaksi sukses
        if ($request->transaction_status == 'settlement') {
            // Update semua tagihan jadi lunas
            $tagihan_ids = json_decode($transaksi->tagihan_ids);
            Tagihan::whereIn('id', $tagihan_ids)->update(['status' => 'lunas']);
        }

        return response()->json(['message' => 'Callback handled'], 200);
    }
}
