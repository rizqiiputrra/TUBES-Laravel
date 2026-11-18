<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        input[type="text"], input[type="password"] {
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
    <h1>Login</h1>
    <p>Silakan masuk ke akun kamu</p>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
            @error('username')
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
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" style="font-weight: normal;">Ingat saya</label>
        </div>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
</body>
</html>
