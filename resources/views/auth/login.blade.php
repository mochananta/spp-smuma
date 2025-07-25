<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | SPP SMKS Muhammadiyah 5 Srono</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
    <section class="login align-items-start min-vh-100"
        style="background-image: url('{{ asset('assets/bg login.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

        <div class="card shadow">
            <div class="card-body">
                <img src="{{ asset('assets/img/logo smuma.png') }}" alt="logo smk" class="d-block mx-auto mb-3"
                    style="max-width: 100px;" />
                <h3 class="text-center mb-4">Selamat Datang</h3>
                <p class="text-center text-primary">Silahkan masuk dengan menggunakan email dan password yang anda
                    miliki</p>

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
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                            required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Masuk Sebagai --
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input untuk Email (Admin) -->
                    <div class="mb-3" id="email-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input untuk NIS (Siswa) -->
                    <div class="mb-3 d-none" id="nis-group">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                            name="nis" value="{{ old('nis') }}" />
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required />
                            <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                <i class="bi bi-eye-slash" id="password-icon"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const emailGroup = document.getElementById('email-group');
            const nisGroup = document.getElementById('nis-group');

            function toggleInputField() {
                const selectedRole = roleSelect.value;
                if (selectedRole === 'admin') {
                    emailGroup.classList.remove('d-none');
                    nisGroup.classList.add('d-none');
                } else if (selectedRole === 'siswa') {
                    emailGroup.classList.add('d-none');
                    nisGroup.classList.remove('d-none');
                } else {
                    emailGroup.classList.remove('d-none');
                    nisGroup.classList.add('d-none');
                }
            }

            roleSelect.addEventListener('change', toggleInputField);
            toggleInputField();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type');
                if (type === 'password') {
                    passwordInput.setAttribute('type', 'text');
                    passwordIcon.classList.remove('bi-eye-slash');
                    passwordIcon.classList.add('bi-eye');
                } else {
                    passwordInput.setAttribute('type', 'password');
                    passwordIcon.classList.remove('bi-eye');
                    passwordIcon.classList.add('bi-eye-slash');
                }
            });
        });
    </script>

</body>

</html>
