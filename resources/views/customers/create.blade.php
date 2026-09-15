@extends('layouts.admin')

@section('title', 'Create Customer')

@section('page-title', 'Create Customer')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Create Customer</h2>

        <p class="text-muted mb-0">
            Add a new customer
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


        <form action="{{ route('customers.store') }}"
              method="POST">

            @csrf


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
                    value="{{ old('name') }}"
                    placeholder="Enter customer name"
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
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
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
                    value="{{ old('phone') }}"
                    placeholder="03XX-XXXXXXX"
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
                    placeholder="Enter customer address"
                >{{ old('address') }}</textarea>

            </div>


            {{-- Buttons --}}
            <button type="submit"
                    class="btn btn-primary">

                Save Customer

            </button>

            <a href="{{ route('customers.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection