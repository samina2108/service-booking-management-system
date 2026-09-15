@extends('layouts.admin')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')

<div class="container-fluid">

    {{-- Success Messages --}}
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show">
            Profile information updated successfully.

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show">
            Password updated successfully.

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Profile Information --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                👤 Profile Information
            </h5>
        </div>

        <div class="card-body">

            @include('profile.partials.update-profile-information-form')

        </div>

    </div>


    {{-- Update Password --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                🔐 Update Password
            </h5>
        </div>

        <div class="card-body">

            @include('profile.partials.update-password-form')

        </div>

    </div>


    {{-- Delete Account --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">
            <h5 class="mb-0 text-danger">
                ⚠️ Delete Account
            </h5>
        </div>

        <div class="card-body">

            @include('profile.partials.delete-user-form')

        </div>

    </div>

</div>

@endsection