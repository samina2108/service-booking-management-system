@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="mb-4">

    <h2>Dashboard</h2>

    <p class="text-muted">
        Welcome to Service Booking Management System
    </p>

</div>


{{-- Service Statistics --}}
<div class="row g-4">

    {{-- Total Services --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Total Services
                        </h6>

                        <h2>
                            {{ $totalServices }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        📋
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Active Services --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Active Services
                        </h6>

                        <h2>
                            {{ $activeServices }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        ✅
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Inactive Services --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Inactive Services
                        </h6>

                        <h2>
                            {{ $inactiveServices }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        ⏸️
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


{{-- Customer Statistics --}}
<div class="row g-4 mt-1">

    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Total Customers
                        </h6>

                        <h2>
                            {{ $totalCustomers }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        👥
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


{{-- Booking Statistics --}}
<div class="row g-4 mt-1">

    {{-- Total Bookings --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Total Bookings
                        </h6>

                        <h2>
                            {{ $totalBookings }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        📅
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Pending --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Pending Bookings
                        </h6>

                        <h2>
                            {{ $pendingBookings }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        ⏳
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Confirmed --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Confirmed Bookings
                        </h6>

                        <h2>
                            {{ $confirmedBookings }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        ✅
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Completed --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Completed Bookings
                        </h6>

                        <h2>
                            {{ $completedBookings }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        🎉
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Cancelled --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Cancelled Bookings
                        </h6>

                        <h2>
                            {{ $cancelledBookings }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        ❌
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Revenue --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>
                        <h6 class="text-muted">
                            Total Revenue
                        </h6>

                        <h2>
                            {{ number_format($totalRevenue, 2) }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        💰
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


{{-- User Statistics --}}
<div class="row g-4 mt-1">

    {{-- Total Users --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6 class="text-muted">
                            Total Users
                        </h6>

                        <h2>
                            {{ $totalUsers }}
                        </h2>

                    </div>

                    <div class="fs-1">
                        👥
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Admin Users --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6 class="text-muted">
                            Admin Users
                        </h6>

                        <h2>
                            {{ $totalAdmins }}
                        </h2>

                    </div>

                    <div class="fs-1">
                        🔴
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Normal Users --}}
    <div class="col-md-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6 class="text-muted">
                            Normal Users
                        </h6>

                        <h2>
                            {{ $totalNormalUsers }}
                        </h2>

                    </div>

                    <div class="fs-1">
                        👤
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- Activity Log Statistics --}}

<div class="row g-4 mt-1">
{{-- Activity Log Statistics --}}
<div class="row mb-4">

    {{-- Total Logs --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Total Logs
                    </h6>

                    <h3 class="mb-0">
                        {{ $totalLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    📊
                </div>

            </div>
        </div>
    </div>


    {{-- Created --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Created
                    </h6>

                    <h3 class="mb-0">
                        {{ $createdLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    ➕
                </div>

            </div>
        </div>
    </div>


    {{-- Updated --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Updated
                    </h6>

                    <h3 class="mb-0">
                        {{ $updatedLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    ✏️
                </div>

            </div>
        </div>
    </div>


    {{-- Deleted --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Deleted
                    </h6>

                    <h3 class="mb-0">
                        {{ $deletedLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    🗑️
                </div>

            </div>
        </div>
    </div>

</div>
</div>

{{-- Quick Actions --}}
<div class="card shadow-sm mt-4">

    <div class="card-body">

        <h5 class="mb-3">
            Quick Actions
        </h5>

        <a href="{{ route('services.create') }}"
           class="btn btn-primary">

            + Add New Service

        </a>

        <a href="{{ route('customers.create') }}"
           class="btn btn-outline-primary">

            + Add Customer

        </a>

        <a href="{{ route('bookings.create') }}"
           class="btn btn-outline-success">

            + Add Booking

        </a>

        <a href="{{ route('services.index') }}"
           class="btn btn-outline-secondary">

            View Services

        </a>

        <a href="{{ route('bookings.index') }}"
           class="btn btn-outline-dark">

            View Bookings

        </a>

    </div>

</div>


{{-- Recent Bookings --}}
<div class="card shadow-sm border-0 mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Recent Bookings
        </h5>

        <a href="{{ route('bookings.index') }}"
           class="btn btn-sm btn-outline-primary">

            View All Bookings

        </a>

    </div>
  


   

    <div class="card-body">

        @if($recentBookings->count() > 0)

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($recentBookings as $booking)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $booking->customer->name }}
                                </td>

                                <td>
                                    {{ $booking->service->name }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                </td>

                                <td>
                                    {{ number_format($booking->price, 2) }}
                                </td>

                                <td>

                                    @if($booking->status == 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif($booking->status == 'confirmed')

                                        <span class="badge bg-primary">
                                            Confirmed
                                        </span>

                                    @elseif($booking->status == 'completed')

                                        <span class="badge bg-success">
                                            Completed
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Cancelled
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('bookings.show', $booking->id) }}"
                                       class="btn btn-sm btn-info">

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center py-4">

                <div style="font-size: 50px;">
                    📅
                </div>

                <h5 class="mt-3">
                    No Recent Bookings
                </h5>

                <p class="text-muted">
                    There are currently no bookings.
                </p>

                <a href="{{ route('bookings.create') }}"
                   class="btn btn-primary">

                    + Create Booking

                </a>

            </div>

        @endif

    </div>

</div>


{{-- Recent Users --}}
<div class="card shadow-sm border-0 mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Recent Users
        </h5>

        <a href="{{ route('users.index') }}"
           class="btn btn-sm btn-outline-primary">

            View All Users

        </a>

    </div>


    <div class="card-body">

        @if($recentUsers->count() > 0)

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Registered
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($recentUsers as $user)

                            <tr>

                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>

                                    @if($user->role === 'admin')

                                        <span class="badge bg-danger">
                                            Admin
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            User
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <p class="text-muted mb-0">
                No users found.
            </p>

        @endif
    </div>

</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Recent Activity Logs</strong>

        <a href="{{ route('activity_logs.index') }}"
           class="btn btn-sm btn-primary">
            View All Activity Logs
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentActivityLogs as $log)
                        <tr>
                            <td>
                                {{ $log->user?->name ?? 'System' }}
                            </td>

                            <td>
                                @if($log->action === 'created')
                                    <span class="badge bg-success">
                                        Created
                                    </span>

                                @elseif($log->action === 'updated')
                                    <span class="badge bg-primary">
                                        Updated
                                    </span>

                                @elseif($log->action === 'deleted')
                                    <span class="badge bg-danger">
                                        Deleted
                                    </span>

                                @elseif($log->action === 'status_changed')
                                    <span class="badge bg-warning text-dark">
                                        Status Changed
                                    </span>

                                @else
                                    <span class="badge bg-secondary">
                                        {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $log->description }}
                            </td>

                            <td>
                                {{ $log->created_at->format('d M Y h:i A') }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4"
                                class="text-center text-muted py-3">
                                No recent activity found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection