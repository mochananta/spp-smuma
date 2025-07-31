<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnis = Alumni::with(['rombel.jurusan'])->get(); 
        return view('admin.alumni.index', compact('alumnis'));
    }
}
