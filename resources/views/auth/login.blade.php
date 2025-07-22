<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | SPP SMKS Muhammadiyah 5 Srono</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      width: 100%;
      max-width: 400px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <section class="login align-items-start min-vh-100" style="background-image: url('{{ asset('assets/bg login.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <div class="card shadow">
      <div class="card-body">
        <img src="{{ asset('assets/img/logo smuma.png') }}" alt="logo smk" class="d-block mx-auto mb-3" style="max-width: 100px;" />
        <h3 class="text-center mb-4">Selamat Datang</h3>
        <p class="text-center text-primary">Silahkan masuk dengan menggunakan email dan password yang anda miliki</p>
        
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
          @csrf
          
          <div class="mb-3">
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
              <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Masuk Sebagai --</option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
              type="email" 
              class="form-control @error('email') is-invalid @enderror" 
              id="email" 
              name="email" 
              value="{{ old('email') }}" 
              required 
              autofocus 
            />
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
              type="password" 
              class="form-control @error('password') is-invalid @enderror" 
              id="password" 
              name="password" 
              required 
            />
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
        
      </div>
    </div>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
