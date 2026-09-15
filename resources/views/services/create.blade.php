@extends('layouts.admin')

@section('title', 'Create Service')

@section('page-title', 'Create Service')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Create Service</h2>
        <p class="text-muted mb-0">
            Add a new service
        </p>
    </div>

    <a href="{{ route('services.index') }}"
       class="btn btn-secondary">
        ← Back to Services
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


        <form action="{{ route('services.store') }}"
              method="POST">

            @csrf

            {{-- Service Name --}}
            <div class="mb-3">

                <label for="name" class="form-label">
                    Service Name <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Enter service name"
                    required
                >

            </div>


            {{-- Description --}}
            <div class="mb-3">

                <label for="description" class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    rows="4"
                    placeholder="Enter service description"
                >{{ old('description') }}</textarea>

            </div>


            {{-- Price --}}
            <div class="mb-3">

                <label for="price" class="form-label">
                    Price <span class="text-danger">*</span>
                </label>

                <input
                    type="number"
                    name="price"
                    id="price"
                    class="form-control"
                    step="0.01"
                    min="0"
                    value="{{ old('price') }}"
                    placeholder="Enter price"
                    required
                >

            </div>


            {{-- Status --}}
            <div class="mb-4">

                <label for="status" class="form-label">
                    Status <span class="text-danger">*</span>
                </label>

                <select
                    name="status"
                    id="status"
                    class="form-select"
                    required
                >

                    <option value="active"
                        {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Buttons --}}
            <button type="submit"
                    class="btn btn-primary">

                Save Service

            </button>

            <a href="{{ route('services.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection