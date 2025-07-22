<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pembayaran SPP - Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #e0f4ff;
    }

    .sidebar {
      width: 250px;
      min-height: 100vh;
      background-color: #a7d5ff;
    }

    .nav-link.active {
      background-color: #6baeff !important;
      color: white !important;
    }

    .sidebar .nav-link {
      font-weight: 600;
      color: white;
    }

    .sidebar .nav-link:hover {
      background-color: #6baeff;
      color: white;
    }
  </style>
  <style>
    body {
      background-color: #e6f3ff;
      font-family: 'Segoe UI', sans-serif;
    }

    .header-box {
      background: linear-gradient(135deg, #69A8FF 0%, #00f2fe 100%);
      padding: 20px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      color: white;
    }

    .header-box .subtext {
      font-size: 14px;
      margin-top: 5px;
    }

    .logo-img {
      height: 60px;
    }

    .card-menu {
      background-color: #a7d5ff;
      border-radius: 15px;
      padding: 30px 15px;
      text-align: center;
      transition: 0.3s;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-menu:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      background-color: #6fbaff;
      color: #fff;
    }

    .card-menu h5 {
      margin-top: 20px;
      font-weight: bold;
    }

    .icon-img {
      width: 64px;
      height: 64px;
    }

    .sidebar {
      background-color: #a7d5ff;
    }

    .sidebar .nav-link {
      color: #fff;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 8px;
      margin-bottom: 5px;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #4f9cff;
      color: white;
    }

    .sidebar .profile-box {
      background-color: #69A8FF;
      border-radius: 12px;
      padding: 10px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar .profile-box img {
      border-radius: 50%;
      width: 64px;
      height: 64px;
      margin-bottom: 5px;
    }

    .sidebar .logout-btn {
      margin-top: 10px;
    }

    .logout-custom {
      background-color: #ffffff;
      color: #a7dfff;
      font-weight: bold;
      padding: 3px 12px;
      font-size: 0.875rem;
      border-radius: 0.25rem;
      display: inline-block;
      text-align: center;
      text-decoration: none;
      transition: 0.3s ease;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      /* ← Ini tambahan bayangannya */
    }

    .logout-custom:hover {
      background-color: #a7dfff;
      color: #fff;
      transition: 0.3s ease;
    }
  </style>

</head>

<body>
  <div class="d-flex">
    @include('siswa.partical.sidebar')

    <div class="flex-grow-1 p-4">
      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>