@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Booking Details
            </h1>

            <p class="text-muted mb-0">
                Booking #{{ $booking->id }}
            </p>
        </div>

        <div>

            <button onclick="window.print()"
                    class="btn btn-outline-dark">
                🖨 Print
            </button>
            
            <a href="{{ route('bookings.invoice', $booking->id) }}"
                 class="btn btn-primary">

                    🧾 Invoice

                      </a>

            <a href="{{ route('bookings.edit', $booking->id) }}"
               class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('bookings.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>


    {{-- Booking Summary --}}
    <div class="card shadow-sm border-0">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Booking Summary
            </h5>

            {{-- Status --}}
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

        </div>


        <div class="card-body">

            <div class="row">

                {{-- Customer --}}
                <div class="col-md-6 mb-4">

                    <h6 class="text-muted">
                        Customer Information
                    </h6>

                    <hr>

                    <p class="mb-2">
                        <strong>Name:</strong>
                        {{ $booking->customer->name }}
                    </p>

                    @if(isset($booking->customer->email))

                        <p class="mb-2">
                            <strong>Email:</strong>
                            {{ $booking->customer->email }}
                        </p>

                    @endif

                    @if(isset($booking->customer->phone))

                        <p class="mb-2">
                            <strong>Phone:</strong>
                            {{ $booking->customer->phone }}
                        </p>

                    @endif

                </div>


                {{-- Service --}}
                <div class="col-md-6 mb-4">

                    <h6 class="text-muted">
                        Service Information
                    </h6>

                    <hr>

                    <p class="mb-2">
                        <strong>Service:</strong>
                        {{ $booking->service->name }}
                    </p>

                    @if(isset($booking->service->description))

                        <p class="mb-2">
                            <strong>Description:</strong>
                            {{ $booking->service->description }}
                        </p>

                    @endif

                </div>


                {{-- Booking Date --}}
                <div class="col-md-4 mb-4">

                    <h6 class="text-muted">
                        Booking Date
                    </h6>

                    <p class="fs-5">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                    </p>

                </div>


                {{-- Booking Time --}}
                <div class="col-md-4 mb-4">

                    <h6 class="text-muted">
                        Booking Time
                    </h6>

                    <p class="fs-5">
                        {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                    </p>

                </div>


                {{-- Price --}}
                <div class="col-md-4 mb-4">

                    <h6 class="text-muted">
                        Price
                    </h6>

                    <p class="fs-5 fw-bold">
                        {{ number_format($booking->price, 2) }}
                    </p>

                </div>


                {{-- Notes --}}
                <div class="col-md-12">

                    <h6 class="text-muted">
                        Notes
                    </h6>

                    <hr>

                    @if($booking->notes)

                        <p>
                            {{ $booking->notes }}
                        </p>

                    @else

                        <p class="text-muted">
                            No notes available.
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="card-footer text-muted">

            Created:
            {{ $booking->created_at->format('d M Y, h:i A') }}

        </div>

    </div>

</div>

@endsection