@extends('layouts.admin')

@section('title', 'Customers')

@section('page-title', 'Customers')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Customers</h2>



        <p class="text-muted mb-0">
            Manage all customers
        </p>
    </div>

    <a href="{{ route('customers.create') }}"
       class="btn btn-primary">

        + Add Customer

    </a>

</div>
<div class="card shadow-sm mb-4">

    <div class="card-body">

        <form action="{{ route('customers.index') }}"
              method="GET">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by name, email or phone..."
                    value="{{ $search ?? '' }}"
                >

                <button type="submit"
                        class="btn btn-primary">
                    Search
                </button>

                @if(!empty($search))

                    <a href="{{ route('customers.index') }}"
                       class="btn btn-secondary">
                        Clear
                    </a>

                @endif

            </div>

        </form>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($customers as $customer)

                    <tr>

                        <td>
                            {{ $customer->id }}
                        </td>

                        <td>
                            <strong>
                                {{ $customer->name }}
                            </strong>
                        </td>

                        <td>
                            {{ $customer->email }}
                        </td>

                        <td>
                            {{ $customer->phone }}
                        </td>

                        <td>
                            {{ $customer->address ?? '-' }}
                        </td>

                        <td>

                            <a href="{{ route('customers.edit', $customer->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            @if(auth()->user()->isAdmin())
                            <form
                                action="{{ route('customers.destroy', $customer->id) }}"
                                method="POST"
                                class="d-inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this customer?')"
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

                            No customers found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-3">

         
            {{ $customers->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection