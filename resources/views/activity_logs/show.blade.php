@extends('layouts.admin')

@section('title', 'Activity Log Details')

@section('page-title', 'Activity Log Details')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <h2>Activity Log Details</h2>

        <p class="text-muted mb-0">
            View complete information about this activity
        </p>

    </div>


    {{-- Activity Log Details Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Activity #{{ $activityLog->id }}
            </h5>

            <a
                href="{{ route('activity_logs.index') }}"
                class="btn btn-secondary btn-sm"
            >
                ← Back to Activity Logs
            </a>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- User --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        User
                    </label>

                    <div class="form-control bg-light">

                        @if($activityLog->user)

                            {{ $activityLog->user->name }}

                        @else

                            <span class="text-muted">
                                Deleted User
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Action --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Action
                    </label>

                    <div>

                        @if($activityLog->action === 'created')

                            <span class="badge bg-success fs-6">
                                Created
                            </span>

                        @elseif($activityLog->action === 'updated')

                            <span class="badge bg-primary fs-6">
                                Updated
                            </span>

                        @elseif($activityLog->action === 'deleted')

                            <span class="badge bg-danger fs-6">
                                Deleted
                            </span>

                        @else

                            <span class="badge bg-secondary fs-6">
                                {{ ucfirst($activityLog->action) }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Description --}}
                <div class="col-12">

                    <label class="form-label fw-bold">
                        Description
                    </label>

                    <div class="form-control bg-light" style="min-height: 80px;">

                        {{ $activityLog->description }}

                    </div>

                </div>


                {{-- Model Type --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Model Type
                    </label>

                    <div class="form-control bg-light">

                    {{ $activityLog->model_name }}

                    </div>

                </div>


                {{-- Model ID --}}
                {{-- Model ID --}}
<div class="col-md-6">

    <label class="form-label fw-bold">
        Model ID
    </label>

    <div class="form-control bg-light">

        @if($activityLog->model_id)

            {{ $activityLog->model_id }}

        @else

            N/A

        @endif

    </div>

</div>


{{-- View Related Record --}}
{{-- View Related Record --}}
@if($activityLog->model_id && $activityLog->model_type)

    <div class="col-md-6">

        <label class="form-label fw-bold">
            Related Record
        </label>

        <div>

            @if($activityLog->model_type === 'App\Models\Booking')

                @php
                    $recordExists = \App\Models\Booking::find($activityLog->model_id);
                @endphp

                @if($recordExists)

                    <a
                        href="{{ route('bookings.show', $activityLog->model_id) }}"
                        class="btn btn-primary"
                    >
                        👁 View Booking
                    </a>

                @else

                    <span class="badge bg-danger">
                        Deleted Booking
                    </span>

                @endif


            @elseif($activityLog->model_type === 'App\Models\Customer')

                @php
                    $recordExists = \App\Models\Customer::find($activityLog->model_id);
                @endphp

                @if($recordExists)

                    <a
                        href="{{ route('customers.show', $activityLog->model_id) }}"
                        class="btn btn-primary"
                    >
                        👁 View Customer
                    </a>

                @else

                    <span class="badge bg-danger">
                        Deleted Customer
                    </span>

                @endif


            @elseif($activityLog->model_type === 'App\Models\Service')

                @php
                    $recordExists = \App\Models\Service::find($activityLog->model_id);
                @endphp

                @if($recordExists)

                    <a
                        href="{{ route('services.show', $activityLog->model_id) }}"
                        class="btn btn-primary"
                    >
                        👁 View Service
                    </a>

                @else

                    <span class="badge bg-danger">
                        Deleted Service
                    </span>

                @endif


            @else

                <span class="text-muted">
                    No related record available
                </span>

            @endif

        </div>

    </div>

@endif

                {{-- Created At --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Created At
                    </label>

                    <div class="form-control bg-light">

                        {{ $activityLog->created_at->format('d M Y, h:i A') }}

                    </div>

                </div>


                {{-- Updated At --}}
                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Updated At
                    </label>

                    <div class="form-control bg-light">

                        {{ $activityLog->updated_at->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection