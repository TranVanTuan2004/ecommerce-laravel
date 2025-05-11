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

        .send {
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

        .text-danger {
            color: red;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="right-panel">
            <div class="logo">
                <h1><span class="blue">HAPPY</span><span class="yellow">SHOP</span></h1>
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="form-card">
                @csrf
                <h3 style="text-align: center">Forgot Your Password?</h3>


                <p style="text-align: center">
                    Remembered your password? <a href="{{ route('login') }}">Login</a>
                </p>

                <p class="or">We'll send you a password reset link via email.</p>

                <label for="email">Enter your email:</label>
                <input type="email" name="email" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <button type="submit" class="send">Send Reset Link</button>
            </form>

        </div>
    </div>
</body>

</html>