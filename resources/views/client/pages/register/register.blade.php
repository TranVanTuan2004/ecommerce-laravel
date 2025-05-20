<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
        }

        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
        }


        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 60px;
        }

        .logo h1 {
            font-size: 28px;
        }

        .blue {
            color: #007bff;
            font-weight: bold;
        }

        .yellow {
            color: #ffc107;
            font-weight: bold;
        }

        .right-panel h2 {
            font-size: 42px;
            margin: 30px 0 20px;
            color: #333;
        }

        .form-card {
            background: #f5f5f5;
            padding: 30px;
            border-radius: 15px;
            max-width: 400px;
            min-width: 400px;
        }

        .form-card h3 {
            margin-bottom: 10px;
        }

        .form-card p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .form-card a {
            color: #007bff;
            text-decoration: none;
        }

        .social-btns {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .social-btns button {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }

        .facebook {
            background-color: #3b5998;
        }

        .google {
            background-color: #db4437;
        }

        .or {
            text-align: center;
            color: #666;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            margin-bottom: 4px;
            border-radius: 5px;
        }

        .register {
            width: 100%;
            background-color: #007bff;
            padding: 12px;
            border: none;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .terms {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            color: #999;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .right-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 30%;
            height: 100%;
        }

        .text-danger {
            color: red;
        }

        .error-message {
            color: #d93025;
            /* Màu đỏ giống Facebook */
            font-size: 14px;
            margin-top: 4px;
        }

        input.error {
            border: 1px solid #d93025;
            background: #fff5f5;
            /* Nền đỏ nhạt */
        }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>

    <body>

        <div class="wrapper">

            <div class="left-panel">

            </div>
            <div class="right-panel">
                <div class="logo">
                    <h1><span class="blue">HAPPY</span><span class="yellow">SHOP</span></h1>
                </div>
                <form method="POST" action="{{ route('register') }}" class="form-card">
                    @csrf
                    <h3 style="text-align: center">Register Now</h3>
                    <p style="text-align: center">Đã có tài khoản <a href="{{ route('login') }}">Login</a></p>
                    <div class="social-btns">
                        <button class="facebook" type="button">Facebook</button>
                        <button class="google" type="button">Google</button>
                    </div>

                    <p class="or">or login with email</p>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Họ và Tên" value="{{ old('name') }}" />
                        @error('name')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your email" value="{{ old('email') }}" />
                        @error('email')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Mật khẩu" />
                        @error('password')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" />
                        @error('password_confirmation')
                        <div class="error-message">>{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="register">Register</button>
                    <p class="terms">Terms & Conditions | Privacy Policy</p>
                </form>
            </div>
        </div>
        </div>
    </body>

    </html>