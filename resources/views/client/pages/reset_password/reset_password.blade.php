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

        .reset {
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
    <div class="wrapper">
        <div class="left-panel"></div>
        <div class="right-panel">
            <div class="logo">
                <h1><span class="blue">HAPPY</span><span class="yellow">SHOP</span></h1>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="form-card">
                @csrf
                <input type="hidden" name="token" value="{{ request()->token }}">

                
                <p style="text-align: center">
                    Don't have an account? <a href="{{ route('register.form') }}">Register</a>
                </p>

                <div class="social-btns">
                    <button class="facebook" type="button">Facebook</button>
                    <button class="google" type="button">Google</button>
                </div>

                <p class="or">or login with email</p>

                <label for="email">Email:</label>
                <input type="email" name="email" required>
                @if ($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif

                <label for="password">New Password:</label>
                <input type="password" name="password" required>
                @if ($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif

                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" required>
                @if ($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
                

                <div>
                    <button type="submit" class="reset">Reset Password</button>
                </div>

                <p class="terms">
                    Terms & Conditions | Privacy Policy | <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>