@extends('layouts.admin')

@section('title', 'Services')

@section('page-title', 'Services')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Services</h2>
        <p class="text-muted mb-0">
            Manage all available services
        </p>
    </div>

    <a href="{{ route('services.create') }}"
       class="btn btn-primary">
        + Add Service
    </a>

</div>


{{-- Search and Filter --}}
<div class="card shadow-sm mb-4">

    <div class="card-body">

        <form action="{{ route('services.index') }}" method="GET">

            <div class="row g-2">

                <div class="col-md-6">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search services..."
                        value="{{ $search ?? '' }}"
                    >

                </div>

                <div class="col-md-3">

                    <select name="status" class="form-select">

                        <option value="">
                            All Status
                        </option>

                        <option value="active"
                            {{ ($status ?? '') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ ($status ?? '') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="col-md-3">

                    <button type="submit"
                            class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('services.index') }}"
                       class="btn btn-secondary">
                        Clear
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- Services Table --}}
<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($services as $service)

                    <tr>

                        <td>
                            {{ $service->id }}
                        </td>

                        <td>
                            <strong>
                                {{ $service->name }}
                            </strong>
                        </td>

                        <td>
                            {{ $service->description ?? '-' }}
                        </td>

                        <td>
                            Rs. {{ number_format($service->price, 2) }}
                        </td>

                        <td>

                            @if($service->status === 'active')

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('services.edit', $service->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            @if(auth()->user()->isAdmin())  
                            <form
                                action="{{ route('services.destroy', $service->id) }}"
                                method="POST"
                                class="d-inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this service?')"
                                >
                                    Delete
                                </button>

                            </form>
                            @endif
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center py-4">

                            No services found.

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="mt-3">

          
            {{ $services->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection