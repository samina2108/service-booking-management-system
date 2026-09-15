
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Service Booking Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .register-card {
            width: 100%;
            max-width: 480px;
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

<div class="register-wrapper">

    <div class="card register-card">

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
                Create your account
            </h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter your name"
                    >
                </div>

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
                        autocomplete="new-password"
                        placeholder="Enter your password"
                    >
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Confirm Password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                    >
                </div>

                <button type="submit"
                        class="btn btn-primary w-100">
                    Create Account
                </button>

            </form>

            <div class="text-center mt-4">

                <span class="text-muted">
                    Already have an account?
                </span>

                <a href="{{ route('login') }}"
                   class="text-decoration-none fw-semibold">
                    Login
                </a>

            </div>

            <div class="text-center mt-3">
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

