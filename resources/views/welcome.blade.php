
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Service Booking Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            color: #212529;
        }

        .hero-text {
            font-size: 18px;
            color: #6c757d;
            line-height: 1.7;
        }

        .feature-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            height: 100%;
        }

        .feature-icon {
            font-size: 38px;
        }

        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg top-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            🔧 Service Booking
        </a>

        <div class="ms-auto">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <span class="badge bg-primary mb-3">
                    Service Management Platform
                </span>

                <h1 class="hero-title mb-4">
                    Service Booking
                    <br>
                    Management System
                </h1>

                <p class="hero-text mb-4">
                    A complete web-based system for managing services,
                    customers, bookings, users and business activities
                    from one centralized platform.
                </p>

                <div class="mb-5">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="btn btn-primary btn-lg me-2">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="btn btn-primary btn-lg me-2">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="btn btn-outline-secondary btn-lg">
                                Create Account
                            </a>
                        @endif
                    @endauth
                </div>

            </div>

            <div class="col-lg-5">

                <div class="row g-3">

                    <div class="col-6">
                        <div class="card feature-card p-4 text-center">
                            <div class="feature-icon mb-2">
                                📋
                            </div>
                            <h5>Services</h5>
                            <p class="text-muted small mb-0">
                                Manage available services and pricing.
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card feature-card p-4 text-center">
                            <div class="feature-icon mb-2">
                                👥
                            </div>
                            <h5>Customers</h5>
                            <p class="text-muted small mb-0">
                                Manage customer information easily.
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card feature-card p-4 text-center">
                            <div class="feature-icon mb-2">
                                📅
                            </div>
                            <h5>Bookings</h5>
                            <p class="text-muted small mb-0">
                                Create and manage service bookings.
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card feature-card p-4 text-center">
                            <div class="feature-icon mb-2">
                                🔐
                            </div>
                            <h5>Role Access</h5>
                            <p class="text-muted small mb-0">
                                Admin and user based access control.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<footer class="text-center py-4 bg-white border-top">
    <p class="text-muted mb-0">
        Service Booking Management System
        &copy; {{ date('Y') }}
    </p>
</footer>

</body>
</html>
