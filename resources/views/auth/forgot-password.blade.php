<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <!-- Email Address -->
        <div class="form-group">
            <input type="email" id="email" class="form-control form-control-user" placeholder="Email Address" name="email" :value="old('email')" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <x-primary-button class="btn btn-success btn-block waves-effect waves-light">
            {{ __('Email Password Reset Link') }}
        </x-primary-button>
    </form>
    <!-- <div class="row mt-5">
        <div class="col-12 text-center">
            <p class="text-muted">Already have account?  <a href="pages-login.html" class="text-muted font-weight-medium ml-1"><b>Sign In</b></a></p>
        </div>
    </div> -->
</x-guest-layout>
