@extends('layouts.admin')

@section('title', 'Customer Details')

@section('page-title', 'Customer Details')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <h2>Customer Details</h2>

        <p class="text-muted mb-0">
            View complete customer information
        </p>

    </div>


    {{-- Customer Details Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Customer #{{ $customer->id }}
            </h5>

            <a
                href="{{ route('customers.index') }}"
                class="btn btn-secondary btn-sm"
            >
                ← Back to Customers
            </a>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- Name --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Name
                    </label>

                    <div class="form-control bg-light">
                        {{ $customer->name }}
                    </div>

                </div>


                {{-- Email --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Email
                    </label>

                    <div class="form-control bg-light">
                        {{ $customer->email }}
                    </div>

                </div>


                {{-- Phone --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Phone
                    </label>

                    <div class="form-control bg-light">
                        {{ $customer->phone }}
                    </div>

                </div>


                {{-- Address --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Address
                    </label>

                    <div class="form-control bg-light">

                        {{ $customer->address ?? 'N/A' }}

                    </div>

                </div>


                {{-- Created At --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Created At
                    </label>

                    <div class="form-control bg-light">

                        {{ $customer->created_at->format('d M Y, h:i A') }}

                    </div>

                </div>


                {{-- Updated At --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Updated At
                    </label>

                    <div class="form-control bg-light">

                        {{ $customer->updated_at->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-4">

                <a
                    href="{{ route('customers.edit', $customer->id) }}"
                    class="btn btn-primary"
                >
                    ✏️ Edit Customer
                </a>

                <a
                    href="{{ route('customers.index') }}"
                    class="btn btn-secondary"
                >
                    Back
                </a>

            </div>

        </div>

    </div>

</div>

@endsection