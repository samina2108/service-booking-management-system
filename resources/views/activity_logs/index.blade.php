@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('page-title', 'Activity Logs')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">
        <h2>Activity Logs</h2>

        <p class="text-muted mb-0">
            View recent activities performed by system users
        </p>
    </div>

  
    {{-- Activity Log Statistics --}}
<div class="row mb-4">

    {{-- Total Logs --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Total Logs
                    </h6>

                    <h3 class="mb-0">
                        {{ $totalLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    📊
                </div>

            </div>
        </div>
    </div>


    {{-- Created --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Created
                    </h6>

                    <h3 class="mb-0">
                        {{ $createdLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    ➕
                </div>

            </div>
        </div>
    </div>


    {{-- Updated --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Updated
                    </h6>

                    <h3 class="mb-0">
                        {{ $updatedLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    ✏️
                </div>

            </div>
        </div>
    </div>


    {{-- Deleted --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-2">
                        Deleted
                    </h6>

                    <h3 class="mb-0">
                        {{ $deletedLogs }}
                    </h3>
                </div>

                <div class="fs-1">
                    🗑️
                </div>

            </div>
        </div>
    </div>

</div>

    {{-- Filters --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            Search & Filters
        </h5>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('activity_logs.index') }}">

            <div class="row g-3">

                {{-- Search --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search description or user..."
                        value="{{ request('search') }}"
                    >

                </div>
             

                {{-- User --}}
                <div class="col-md-2">

                    <label class="form-label">
                        User
                    </label>

                    <select name="user_id" class="form-select">

                        <option value="">
                            All Users
                        </option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ request('user_id') == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Action --}}
                <div class="col-md-2">

                    <label class="form-label">
                        Action
                    </label>

                    <select name="action" class="form-select">

                        <option value="">
                            All Actions
                        </option>

                        <option
                            value="created"
                            {{ request('action') == 'created' ? 'selected' : '' }}
                        >
                            Created
                        </option>

                        <option
                            value="updated"
                            {{ request('action') == 'updated' ? 'selected' : '' }}
                        >
                            Updated
                        </option>

                        <option
                            value="deleted"
                            {{ request('action') == 'deleted' ? 'selected' : '' }}
                        >
                            Deleted
                        </option>

                    </select>

                </div>


                {{-- Date --}}
                <div class="col-md-2">

                    <label class="form-label">
                        Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ request('date') }}"
                    >

                </div>


                {{-- Buttons --}}
                <div class="col-md-2 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        🔍 Search
                    </button>

                    <a
                        href="{{ route('activity_logs.index') }}"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>

                    <a
    href="{{ route('activity_logs.export', request()->query()) }}"
    class="btn btn-success"
>
    📥 Export CSV
</a>

                </div>

            </div>

        </form>

    </div>

</div>

    {{-- Activity Logs Table --}}
    <div class="card shadow-sm border-0">

        <div class="card-header">

            <h5 class="mb-0">
                All Activities
            </h5>

        </div>


        <div class="card-body">

            @if($logs->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>User</th>

                                <th>Action</th>

                                <th>Description</th>

                                <th>Date & Time</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($logs as $log)

                                <tr>

                                    {{-- ID --}}
                                    <td>
                                        {{ $logs->firstItem() + $loop->index }}
                                    </td>


                                    {{-- User --}}
                                    <td>

                                        @if($log->user)

                                            <strong>
                                                {{ $log->user->name }}
                                            </strong>

                                        @else

                                            <span class="text-muted">
                                                Deleted User
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td>

                                        @if($log->action === 'created')

                                            <span class="badge bg-success">
                                                Created
                                            </span>

                                        @elseif($log->action === 'updated')

                                            <span class="badge bg-primary">
                                                Updated
                                            </span>

                                        @elseif($log->action === 'deleted')

                                            <span class="badge bg-danger">
                                                Deleted
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($log->action) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Description --}}
                                    <td>
                                        {{ $log->description }}
                                    </td>


                                    {{-- Date --}}
                                    <td>
                                        
                                    <div>
                              {{ $log->created_at->format('d M Y, h:i A') }}

                              @if($log->created_at->diffInHours(now()) < 24)
                                  <span class="badge bg-warning text-dark ms-1">
                                      Recent
                                   </span>
                              @endif                              
                            
                            </div>
                                    </td>

                                    <td>

                                   <a
                                       href="{{ route('activity_logs.show', $log->id) }}"
                                       class="btn btn-sm btn-info"
                                   >
                                       👁 View
                                   </a>
                                   {{-- Delete --}}
    <form
        action="{{ route('activity_logs.destroy', $log->id) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('Are you sure you want to delete this activity log?');"
    >

        @csrf

        @method('DELETE')

        <button
            type="submit"
            class="btn btn-sm btn-danger"
        >
            🗑️ Delete
        </button>

    </form>


                                   </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="mt-3">

                    
                    {{ $logs->links('pagination::bootstrap-5') }}

                </div>

            @else

                <div class="text-center py-5">

                    <div style="font-size: 50px;">
                        📋
                    </div>

                    <h5 class="mt-3">
                        No Activity Found
                    </h5>

                    <p class="text-muted">
                        No activities have been recorded yet.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection