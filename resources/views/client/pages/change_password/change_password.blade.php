</body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #007bff;
        }

        p {
            margin-top: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Change Password</h2>


        <form action="{{ route('changepassword') }}" method="POST">
            @csrf
            <div class="form-group">

                <input type="password" name="current_password" id="current_password" placeholder="Current your password" required>
                @error('current_password')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

                <input type="password" name="new_password"  placeholder="Enter new password" required>
                @error('new_password')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

                <input type="password" name="new_password_confirmation"  placeholder="Confirm new password" required>
                @error('new_password_confirmation')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Update</button>
        </form>
        <p><a href="{{ route('home') }}">Back</a></p>
    </div>
</body>

</html>

</html>