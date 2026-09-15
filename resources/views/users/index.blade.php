@extends('layouts.admin')

@section('title', 'User Management')

@section('page-title', 'User Management')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>User Management</h2>

            <p class="text-muted mb-0">
                Manage system users and their roles
            </p>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif
    {{-- Search & Filter --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <form method="GET"
              action="{{ route('users.index') }}">

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Search
                    </label>

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name or email..."
                           value="{{ request('search') }}">

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        Role
                    </label>

                    <select name="role"
                            class="form-select">

                        <option value="">
                            All Roles
                        </option>

                        <option value="user"
    {{ request('role') === 'user' ? 'selected' : '' }}>
    User
</option>

<option value="admin"
    {{ request('role') === 'admin' ? 'selected' : '' }}>
    Admin
</option>

                    </select>

                </div>


                <div class="col-md-3 d-flex align-items-end">

                    <button type="submit"
                            class="btn btn-primary me-2">

                        🔍 Search

                    </button>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

    {{-- Users Table --}}
    <div class="card shadow-sm border-0">

        <div class="card-header">

            <h5 class="mb-0">
                All Users
            </h5>

        </div>


        <div class="card-body">

            @if($users->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Role
                                </th>

                                <th>
                                    Registered
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($users as $user)

                                <tr>

                                    <td>
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>


                                    <td>

                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                        @if($user->id === auth()->id())

                                            <span class="badge bg-info">
                                                You
                                            </span>

                                        @endif

                                    </td>


                                    <td>
                                        {{ $user->email }}
                                    </td>


                                    {{-- Role --}}
                                    <td>

                                    @if($user->userRole && $user->userRole->name === 'admin')
                                     <span class="badge bg-danger">
                                         Admin
                                     </span>
                                 @else
                                     <span class="badge bg-secondary">
                                         User
                                     </span>
                                 @endif

                                    </td>


                                    {{-- Registered --}}
                                    <td>

                                        {{ $user->created_at->format('d M Y') }}

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        {{-- Role Update --}}

                                        <form method="POST"
                                              action="{{ route('users.updateRole', $user->id) }}"
                                              class="d-inline">

                                            @csrf

                                            @method('PATCH')

                                            <select name="role"
                                                    class="form-select form-select-sm d-inline-block"
                                                    style="width: 110px;"
                                                    onchange="this.form.submit()">

                                                    <option value="user"
    {{ $user->userRole && $user->userRole->name === 'user' ? 'selected' : '' }}>
    User
</option>

<option value="admin"
    {{ $user->userRole && $user->userRole->name === 'admin' ? 'selected' : '' }}>
    Admin
</option>

                                            </select>

                                        </form>


                                        {{-- Delete --}}

                                        @if($user->id !== auth()->id())

                                            <form method="POST"
                                                  action="{{ route('users.destroy', $user->id) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this user?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger">

                                                    Delete

                                                </button>

                                            </form>

                                        @else

                                            <span class="text-muted small">
                                                Current account
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}

                <div class="mt-3">

                  
                    {{ $users->links('pagination::bootstrap-5') }}

                </div>


            @else

                <div class="text-center py-5">

                    <div style="font-size: 50px;">
                        👥
                    </div>

                    <h5 class="mt-3">
                        No Users Found
                    </h5>

                    <p class="text-muted">
                        There are currently no users.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection