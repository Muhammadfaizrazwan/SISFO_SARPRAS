<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, #0000ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: black;
        }

        .form-subtitle {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: black;
        }

        .form-group {
            position: relative;
            margin-bottom: 15px;
        }

        .form-control {
            background: #eee;
            border: none;
            border-radius: 15px;
            padding: 10px 15px 10px 40px;
            font-size: 14px;
        }

        .form-control:focus {
            background: #e0e0e0;
            box-shadow: none;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #555;
        }

        .btn-primary {
            background: grey;
            border: none;
            border-radius: 15px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background: #6a11cb;
        }

        .form-footer {
            font-size: 12px;
            margin-top: 15px;
        }

        .form-footer a {
            color: blue;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 14px;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<!-- ...head & style tetap... -->

<body>
    <div class="login-container">
        <h2 class="form-title">SISFO SARPRAS</h2>
        <h5 class="form-subtitle">Login</h5>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('actionlogin') }}" method="post">
            @csrf
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>

            <div class="form-footer">
                Don't have an account yet? <a href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
