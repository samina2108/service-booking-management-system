<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Booking Invoice #{{ $booking->id }}
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            background: #f5f6fa;
        }

        .invoice-container {
            max-width: 900px;
            margin: 40px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
        }

        .invoice-price {
            font-size: 22px;
            font-weight: bold;
        }

        @media print {

            body {
                background: #ffffff;
            }

            .no-print {
                display: none !important;
            }

            .invoice-container {
                margin: 0;
                max-width: 100%;
                box-shadow: none !important;
            }

        }

    </style>

</head>


<body>

<div class="invoice-container shadow-sm">

    {{-- Header --}}

    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>

            <h1 class="invoice-title">
                Service Booking
            </h1>

            <p class="text-muted mb-0">
                Service Booking Management System
            </p>

        </div>


        <div class="text-end">

            <h3>
                INVOICE
            </h3>

            <p class="mb-1">
                Booking #{{ $booking->id }}
            </p>

            <p class="text-muted">
                {{ $booking->created_at->format('d M Y') }}
            </p>

        </div>

    </div>


    <hr>


    {{-- Customer & Service --}}

    <div class="row mt-4">

        <div class="col-md-6">

            <h6 class="text-muted">
                CUSTOMER
            </h6>

            <h5>
                {{ $booking->customer->name }}
            </h5>

            @if($booking->customer->email)

                <p class="mb-1">
                    {{ $booking->customer->email }}
                </p>

            @endif

            @if($booking->customer->phone)

                <p>
                    {{ $booking->customer->phone }}
                </p>

            @endif

        </div>


        <div class="col-md-6">

            <h6 class="text-muted">
                SERVICE
            </h6>

            <h5>
                {{ $booking->service->name }}
            </h5>

            @if($booking->service->description)

                <p>
                    {{ $booking->service->description }}
                </p>

            @endif

        </div>

    </div>


    {{-- Booking Information --}}

    <div class="table-responsive mt-4">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>
                        Booking Date
                    </th>

                    <th>
                        Booking Time
                    </th>

                    <th>
                        Status
                    </th>

                    <th class="text-end">
                        Price
                    </th>

                </tr>

            </thead>


            <tbody>

                <tr>

                    <td>
                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                    </td>

                    <td>
                        {{ ucfirst($booking->status) }}
                    </td>

                    <td class="text-end invoice-price">

                        {{ number_format($booking->price, 2) }}

                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    {{-- Notes --}}

    @if($booking->notes)

        <div class="mt-4">

            <h6 class="text-muted">
                NOTES
            </h6>

            <p>
                {{ $booking->notes }}
            </p>

        </div>

    @endif


    <hr>


    {{-- Total --}}

    <div class="row">

        <div class="col-md-8"></div>

        <div class="col-md-4">

            <div class="d-flex justify-content-between">

                <strong>
                    Total
                </strong>

                <strong class="invoice-price">

                    {{ number_format($booking->price, 2) }}

                </strong>

            </div>

        </div>

    </div>


    {{-- Buttons --}}

    <div class="text-center mt-5 no-print">

        <button onclick="window.print()"
                class="btn btn-primary">

            🖨 Print Invoice

        </button>


        <a href="{{ route('bookings.show', $booking->id) }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>


    <div class="text-center mt-5">

        <small class="text-muted">

            Thank you for choosing our service.

        </small>

    </div>

</div>

</body>

</html>