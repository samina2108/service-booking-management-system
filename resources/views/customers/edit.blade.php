@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('page-title', 'Edit Customer')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Edit Customer</h2>

        <p class="text-muted mb-0">
            Update customer information
        </p>
    </div>

    <a href="{{ route('customers.index') }}"
       class="btn btn-secondary">
        ← Back to Customers
    </a>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Please fix the following errors:</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('customers.update', $customer->id) }}"
              method="POST">

            @csrf

            @method('PUT')


            {{-- Name --}}
            <div class="mb-3">

                <label for="name" class="form-label">
                    Customer Name <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name', $customer->name) }}"
                    required
                >

            </div>


            {{-- Email --}}
            <div class="mb-3">

                <label for="email" class="form-label">
                    Email <span class="text-danger">*</span>
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="{{ old('email', $customer->email) }}"
                    required
                >

            </div>


            {{-- Phone --}}
            <div class="mb-3">

                <label for="phone" class="form-label">
                    Phone <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    class="form-control"
                    value="{{ old('phone', $customer->phone) }}"
                    required
                >

            </div>


            {{-- Address --}}
            <div class="mb-4">

                <label for="address" class="form-label">
                    Address
                </label>

                <textarea
                    name="address"
                    id="address"
                    class="form-control"
                    rows="4"
                >{{ old('address', $customer->address) }}</textarea>

            </div>


            <button type="submit"
                    class="btn btn-primary">

                Update Customer

            </button>

            <a href="{{ route('customers.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection