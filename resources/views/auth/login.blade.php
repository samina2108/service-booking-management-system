```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Service Booking Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            border: none;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
        }

        .brand-icon {
            font-size: 42px;
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="card login-card">

        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">

                <div class="brand-icon mb-2">
                    🔧
                </div>

                <h3 class="fw-bold mb-1">
                    Service Booking
                </h3>

                <p class="text-muted mb-0">
                    Management System
                </p>

            </div>

            <h5 class="text-center mb-4">
                Login to your account
            </h5>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email"
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    >
                </div>

                <div class="form-check mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember_me"
                    >

                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                        class="btn btn-primary w-100">
                    Login
                </button>

            </form>

            <div class="text-center mt-4">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-decoration-none">
                        Forgot your password?
                    </a>
                @endif

            </div>

            @if (Route::has('register'))
                <div class="text-center mt-3">

                    <span class="text-muted">
                        Don't have an account?
                    </span>

                    <a href="{{ route('register') }}"
                       class="text-decoration-none fw-semibold">
                        Register
                    </a>

                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ url('/') }}"
                   class="text-muted text-decoration-none">
                    ← Back to Home
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
```
