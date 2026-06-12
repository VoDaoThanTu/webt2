<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121824;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #FFFFFF;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-box {
            background-color: #1E2640;
            border: 1px solid #2D3748;
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .login-brand {
            font-size: 24px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #00F0FF;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #2D3748;
            padding-bottom: 15px;
        }

        .form-group {
            margin-bottom: 22px;
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

        .btn-login {
            width: 100%;
            background-color: #00F0FF;
            color: #121824;
            font-weight: 700;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #00D8E6;
        }

        .error-msg {
            color: #EF4444;
            font-size: 13px;
            font-weight: 600;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div class="login-brand">Tech Pulse</div>

    <form action="{{ route('login.handle') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
            @error('email')
            <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
            @error('password')
            <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-login">Login</button>
        <div class="text-center mt-3" style="font-size: 14px;">
            <a href="{{ url('/register') }}" style="color: #94A3B8; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#00F0FF'" onmouseout="this.style.color='#94A3B8'">
                Register
            </a>
        </div>
    </form>
</div>

</body>
</html>
