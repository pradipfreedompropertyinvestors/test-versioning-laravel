<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="user needs-validation">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <input type="email" name="email" :value="old('email')" autofocus class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <input type="password" name="password" class="form-control  @error('email') is-invalid @enderror" id="password" placeholder="Password" autocomplete="current-password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <x-primary-button class="btn btn-success btn-block waves-effect waves-light">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
    <div class="row mt-4">
        <div class="col-12 text-center">
            @if (Route::has('password.request'))
            <!-- <p class="text-muted mb-2"><a href="{{ route('password.request') }}" class="text-muted font-weight-medium ml-1">{{ __('Forgot your password?') }}</a></p> -->
            @endif
            <!-- <p class="text-muted mb-0">Don't have an account? <a href="pages-register.html" class="text-muted font-weight-medium ml-1"><b>Sign Up</b></a></p> -->
        </div> <!-- end col -->
    </div>
</x-guest-layout>
