@extends('layouts.admin')

@section('title', 'Create Booking')

@section('page-title', 'Create Booking')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Add Booking</h1>

        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Booking Information</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Customer --}}
                    <div class="col-md-6 mb-3">
                        <label for="customer_id" class="form-label">
                            Customer <span class="text-danger">*</span>
                        </label>

                        <select name="customer_id" id="customer_id" class="form-control" required>
                            <option value="">Select Customer</option>

                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Service --}}
                    <div class="col-md-6 mb-3">

    <label for="service_id" class="form-label">
        Service <span class="text-danger">*</span>
    </label>

    <select name="service_id"
            id="service_id"
            class="form-control"
            required>

        <option value="">Select Service</option>

        @foreach($services as $service)

            <option value="{{ $service->id }}"
                    data-price="{{ $service->price }}">
                {{ $service->name }}
            </option>

        @endforeach

    </select>

</div>

                    {{-- Booking Date --}}
                    <div class="col-md-6 mb-3">
                        <label for="booking_date" class="form-label">
                            Booking Date <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                          name="booking_date"
                          id="booking_date"
                          class="form-control"
                          min="{{ date('Y-m-d') }}"
                          required>
                    </div>

                    {{-- Booking Time --}}
                    <div class="col-md-6 mb-3">
                        <label for="booking_time" class="form-label">
                            Booking Time <span class="text-danger">*</span>
                        </label>

                        <input type="time"
                               name="booking_time"
                               id="booking_time"
                               class="form-control"
                               required>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-6 mb-3">

    <label for="price" class="form-label">
        Price <span class="text-danger">*</span>
    </label>

    <input type="number"
           name="price"
           id="price"
           class="form-control"
           step="0.01"
           min="0"
           required>

</div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select name="status" id="status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    {{-- Notes --}}
                    <div class="col-md-12 mb-3">
                        <label for="notes" class="form-label">
                            Notes
                        </label>

                        <textarea name="notes"
                                  id="notes"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Enter booking notes..."></textarea>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Booking
                    </button>

                    <a href="{{ route('bookings.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
<script>
    document.getElementById('service_id').addEventListener('change', function () {

        let selectedOption = this.options[this.selectedIndex];

        let price = selectedOption.getAttribute('data-price');

        document.getElementById('price').value = price || '';

    });
</script>
@endsection