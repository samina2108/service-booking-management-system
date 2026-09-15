@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3">Bookings</h1>

        <a href="{{ route('bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Booking
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Search & Filters --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('bookings.index') }}">

                <div class="row">

                    {{-- Customer Search --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Search Customer
                        </label>

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Enter customer name"
                               value="{{ request('search') }}">

                    </div>


                    {{-- Status Filter --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">

                            <option value="">
                                All Status
                            </option>

                            <option value="pending"
                                {{ request('status') == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="confirmed"
                                {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>

                            <option value="completed"
                                {{ request('status') == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="cancelled"
                                {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                    </div>


                    {{-- Booking Date --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Booking Date
                        </label>

                        <input type="date"
                               name="booking_date"
                               class="form-control"
                               value="{{ request('booking_date') }}">

                    </div>


                    {{-- Search & Reset --}}
                    <div class="col-md-2 mb-3 d-flex align-items-end">

                        <button type="submit"
                                class="btn btn-primary me-2">
                            Search
                        </button>

                        <a href="{{ route('bookings.index') }}"
                           class="btn btn-secondary">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Bookings Table --}}
    <div class="card shadow-sm">

        <div class="card-header">

            <h5 class="mb-0">
                All Bookings
            </h5>

        </div>


        <div class="card-body">

            @if($bookings->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Customer</th>

                                <th>Service</th>

                                <th>Date</th>

                                <th>Time</th>

                                <th>Price</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($bookings as $booking)

                                <tr>

                                    {{-- ID --}}
                                    <td>
                                        {{ $booking->id }}
                                    </td>


                                    {{-- Customer --}}
                                    <td>
                                        {{ $booking->customer->name }}
                                    </td>


                                    {{-- Service --}}
                                    <td>
                                        {{ $booking->service->name }}
                                    </td>


                                    {{-- Date --}}
                                    <td>
                                        {{ $booking->booking_date }}
                                    </td>


                                    {{-- Time --}}
                                    <td>
                                        {{ $booking->booking_time }}
                                    </td>


                                    {{-- Price --}}
                                    <td>
                                        {{ number_format($booking->price, 2) }}
                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        <form action="{{ route('bookings.updateStatus', $booking->id) }}"
                                              method="POST">

                                            @csrf

                                            @method('PATCH')

                                            <select name="status"
                                                    class="form-select form-select-sm"
                                                    onchange="this.form.submit()">

                                                <option value="pending"
                                                    {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>

                                                <option value="confirmed"
                                                    {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                                    Confirmed
                                                </option>

                                                <option value="completed"
                                                    {{ $booking->status == 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>

                                                <option value="cancelled"
                                                    {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>

                                            </select>

                                        </form>

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        {{-- View --}}
                                        <a href="{{ route('bookings.show', $booking->id) }}"
                                           class="btn btn-sm btn-info">
                                            View
                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('bookings.edit', $booking->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>


                                        {{-- Delete --}}

                                        @if(auth()->user()->isAdmin())
                                        <form action="{{ route('bookings.destroy', $booking->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this booking?');">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Delete
                                            </button>

                                        </form>
                                        @endif
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="mt-3">

                {{ $bookings->links('pagination::bootstrap-5') }}

                </div>


            @else

                <div class="text-center py-4">

                    <p class="text-muted mb-0">
                        No bookings found.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection