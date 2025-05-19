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
                    <h3 style="text-align: center">Xác thực email</h3>
                    <p>Xin chào {{ $user->name }},</p>
                    <p>Vui lòng nhấp vào liên kết dưới đây để kích hoạt tài khoản:</p>
                     <a href="{{ $url }}">Xác thực tài khoản</a>
                </form>
            </div>
        </div>
        </div>
    </body>

    </html>