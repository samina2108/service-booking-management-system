<section>

    <div class="mb-4">
        <h5 class="mb-1">
            {{ __('Profile Information') }}
        </h5>

        <p class="text-muted mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </div>

    {{-- Email Verification Form --}}
    <form id="send-verification"
          method="post"
          action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Profile Update Form --}}
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="mb-3">

            <label for="name" class="form-label">
                {{ __('Name') }}
            </label>

            <input
                id="name"
                name="name"
                type="text"
                class="form-control @if($errors->has('name')) is-invalid @endif"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >

            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif

        </div>


        {{-- Email --}}
        <div class="mb-3">

            <label for="email" class="form-label">
                {{ __('Email') }}
            </label>

            <input
                id="email"
                name="email"
                type="email"
                class="form-control @if($errors->has('email')) is-invalid @endif"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >

            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif


            {{-- Email Verification --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3">

                    <div class="alert alert-warning mb-2">
                        <strong>
                            {{ __('Your email address is unverified.') }}
                        </strong>
                    </div>

                    <button
                        form="send-verification"
                        type="submit"
                        class="btn btn-outline-primary btn-sm"
                    >
                        📧 {{ __('Re-send verification email') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')

                        <div class="alert alert-success mt-3 mb-0">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>

                    @endif

                </div>

            @endif

        </div>


        {{-- Save Button --}}
        <div class="d-flex align-items-center gap-3">

            <button type="submit" class="btn btn-primary">
                💾 {{ __('Save') }}
            </button>

        </div>

    </form>

</section>