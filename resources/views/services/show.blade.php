@extends('layouts.admin')

@section('title', 'Service Details')

@section('page-title', 'Service Details')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <h2>Service Details</h2>

        <p class="text-muted mb-0">
            View complete service information
        </p>

    </div>


    {{-- Service Details Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Service #{{ $service->id }}
            </h5>

            <a
                href="{{ route('services.index') }}"
                class="btn btn-secondary btn-sm"
            >
                ← Back to Services
            </a>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- Service Name --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Service Name
                    </label>

                    <div class="form-control bg-light">
                        {{ $service->name }}
                    </div>

                </div>


                {{-- Price --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Price
                    </label>

                    <div class="form-control bg-light">
                        {{ number_format($service->price, 2) }}
                    </div>

                </div>


                {{-- Status --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Status
                    </label>

                    <div>

                        @if($service->status === 'active')

                            <span class="badge bg-success fs-6">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger fs-6">
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Description --}}
                <div class="col-12">

                    <label class="form-label fw-bold">
                        Description
                    </label>

                    <div
                        class="form-control bg-light"
                        style="min-height: 100px;"
                    >
                        {{ $service->description ?? 'N/A' }}
                    </div>

                </div>


                {{-- Created At --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Created At
                    </label>

                    <div class="form-control bg-light">

                        {{ $service->created_at->format('d M Y, h:i A') }}

                    </div>

                </div>


                {{-- Updated At --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Updated At
                    </label>

                    <div class="form-control bg-light">

                        {{ $service->updated_at->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-4">

                <a
                    href="{{ route('services.edit', $service->id) }}"
                    class="btn btn-primary"
                >
                    ✏️ Edit Service
                </a>

                <a
                    href="{{ route('services.index') }}"
                    class="btn btn-secondary"
                >
                    Back
                </a>

            </div>

        </div>

    </div>

</div>

@endsection