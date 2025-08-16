<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

    <!-- Custom CSS -->
    <style>
        /* Full page background */
        body {
            background: url('{{ asset('images/bg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Muli', sans-serif;
            min-height: 100vh;
        }

        /* Center the login card */
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Card container */
        .form-holder {
            width: 100%;
            max-width: 900px;
            display: flex;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Left info panel */
        .info {
            background: linear-gradient(135deg, rgb(185, 135, 135), #444343);
            color: #fff;
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Right form panel with transparency */
        .form-panel {
            flex: 1;
            padding: 40px;
            background: rgba(255,255,255,0.85); /* semi-transparent */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-panel .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background: linear-gradient(135deg, rgb(185, 135, 135), #444343);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, rgb(187, 113, 113), #444343);
            border: none;
        }

        .forgot-pass {
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="form-holder">
        <!-- Left Panel -->
        <div class="info">
            <h1>Dashboard</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>

        <!-- Right Panel (Laravel Form) -->
        <div class="form-panel">

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Log in</button>

                @if (Route::has('password.request'))
                    <a class="forgot-pass" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <div class="mt-3">
                    <small>Do not have an account?</small>
                    <a href="{{ route('register') }}" class="ml-1">Signup</a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JS (CDN) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
