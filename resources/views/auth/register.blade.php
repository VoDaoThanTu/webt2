<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0F131E;
            color: #E2E8F0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-box {
            background-color: #1E2640;
            border: 1px solid #2D3748;
            border-radius: 8px;
            padding: 35px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }
        .register-title {
            font-size: 22px;
            font-weight: 800;
            text-transform: uppercase;
            color: #00F0FF;
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #94A3B8;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            background-color: #0F131E;
            border: 1px solid #2D3748;
            color: #FFFFFF;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            border-color: #00F0FF;
            outline: none;
        }
        .btn-register {
            width: 100%;
            background-color: #00F0FF;
            color: #121824;
            font-weight: 700;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-transform: uppercase;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-register:hover {
            background-color: #00D8E6;
        }
    </style>
</head>
<body>

<div class="register-box">
    <div class="register-title">Register</div>

    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid #EF4444; color: #EF4444; padding: 10px; border-radius: 4px; font-size: 14px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 15px; font-weight: 600;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" placeholder="Fullname" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="max 6 numbers" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Re-enter password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" required>
        </div>

        <button type="submit" class="btn-register">Register</button>

        <div class="text-center mt-3" style="font-size: 14px;">
            <a href="{{ url('/login') }}" style="color: #94A3B8; text-decoration: none;">Login</a>
        </div>
    </form>
</div>

</body>
</html>
