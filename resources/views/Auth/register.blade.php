<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, #0000ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .form-container {
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
            margin-bottom: 20px;
            color: black;
        }

        .form-label {
            display: flex;
            align-items: center;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-label i {
            margin-right: 8px;
        }

        .form-control, .form-select {
            background: #eee;
            border: none;
            border-radius: 15px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-control:focus, .form-select:focus {
            background: #e0e0e0;
            box-shadow: none;
            border-color: transparent;
        }

        .btn-primary {
            background: grey;
            border: none;
            border-radius: 15px;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
            width: 100%;
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

<body>
    <div class="form-container">
        <h2 class="form-title">SISFO SARPRAS</h2>

        <h5 class="mb-3">Register</h5>

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

        <form action="{{ route('actionregister') }}" method="post">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

            <div class="form-footer">
                Already have an Account? <a href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
