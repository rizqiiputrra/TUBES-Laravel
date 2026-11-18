<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 15px;
            margin-top: 6px;
        }
        label {
            font-weight: 600;
            font-size: 14px;
            color: #2c3e50;
        }
        .field {
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-size: 13px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <h1>Daftar Akun</h1>
    <p>Buat akun baru untuk memesan tiket</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label>Nama Lengkap:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Password:</label><br>
            <input type="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Konfirmasi Password:</label><br>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>
