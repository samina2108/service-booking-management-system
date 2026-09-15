<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Service Booking')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
        }

        .sidebar .brand {
            font-size: 22px;
            font-weight: bold;
            padding: 20px;
            color: white;
        }

        .sidebar a {
            display: block;
            color: #ced4da;
            text-decoration: none;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: white;
        }

        .sidebar a.active {
    background-color: #343a40;
    color: white;
    font-weight: 600;
    border-left: 4px solid #0d6efd;
}

        .main-content {
            min-height: 100vh;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <div class="col-md-2 col-lg-2 p-0 sidebar">

            <div class="brand">
                Service Booking
            </div>

            <nav>

            <a href="{{ route('dashboard') }}"
   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
    🏠 Dashboard
</a>

<a href="{{ route('services.index') }}"
   class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
    📋 Services
</a>

<a href="{{ route('services.create') }}"
   class="{{ request()->routeIs('services.create') ? 'active' : '' }}">
    ➕ Add Service
</a>

    <a href="{{ route('customers.index') }}"
   class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
    👥 Customers
</a>

<a href="{{ route('bookings.index') }}"
   class="{{ request()->routeIs('bookings.*') ? 'active' : '' }}">
    📅 Bookings
</a>

@if(auth()->user()->isAdmin())

    <a href="{{ route('users.index') }}"
       class="{{ request()->routeIs('users.*') ? 'active' : '' }}">

        👥 Users

    </a>

@endif

@if(auth()->user()->isAdmin())

    <a href="{{ route('activity_logs.index') }}"
       class="{{ request()->routeIs('activity_logs.*') ? 'active' : '' }}">

        📋 Activity Logs

    </a>

@endif

    <a href="#">
        ⚙️ Settings
    </a>



    <form method="POST" action="{{ route('logout') }}" class="mt-3">
    @csrf

    <button type="submit"
            class="btn btn-danger w-100">
        🚪 Logout
    </button>
</form>

</nav>

        </div>

        {{-- Main Content --}}
        <div class="col-md-10 col-lg-10 p-0 main-content">

            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg bg-white border-bottom px-4">

                <div class="container-fluid">

                    <span class="navbar-brand">
                        @yield('page-title', 'Dashboard')
                    </span>

                    <div class="dropdown ms-auto">

    <button class="btn btn-light dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">

        👤 {{ auth()->user()->name }}

    </button>

    <ul class="dropdown-menu dropdown-menu-end">

    {{-- User Information --}}
    <li class="px-3 py-2">

        <div class="fw-bold">
            {{ auth()->user()->name }}
        </div>

        <small>

    @if(auth()->user()->isAdmin())

        <span class="badge bg-danger">
            Administrator
        </span>

    @else

        <span class="badge bg-primary">
            User
        </span>

    @endif

</small>

    </li>

    <li>
        <hr class="dropdown-divider">
    </li>

    {{-- Profile --}}
    <li>
        <a class="dropdown-item"
           href="{{ route('profile.edit') }}">
            👤 My Profile
        </a>
    </li>

    <li>
        <hr class="dropdown-divider">
    </li>

    {{-- Logout --}}
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="dropdown-item text-danger">
                🚪 Logout
            </button>
        </form>
    </li>

</ul>

</div>

                </div>

            </nav>

            {{-- Page Content --}}
            <main class="p-4">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                {{-- Error Message --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif
                @include('components.alert')
                @yield('content')

            </main>

        </div>

    </div>
</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>