<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

    <!-- Custom CSS -->
    <style>
        body {
            background: url('{{ asset('images/bg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Muli', sans-serif;
            min-height: 100vh;
        }

        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-holder {
            width: 100%;
            max-width: 900px;
            display: flex;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            border-radius: 10px;
            overflow: hidden;
        }

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

        .terms {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
<div class="register-page">
    <div class="form-holder">
        <!-- Left Panel -->
        <div class="info">
            <h1>Register</h1>
            <p>Join our dashboard and manage your account seamlessly.</p>
        </div>

        <!-- Right Panel (Laravel Form) -->
        <div class="form-panel">

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group terms">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline">Terms of Service</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline">Privacy Policy</a>',
                                ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary btn-block">Register</button>

                <div class="mt-3 text-center">
                    <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
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
