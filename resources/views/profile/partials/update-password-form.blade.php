<section>
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header> -->

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 needs-validation">
        @csrf
        @method('put')

        <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i> Change Password</h5>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter Current Password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!-- end col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!-- end col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!-- end col -->
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-primary-button class="btn btn-success mt-2"><i class="mdi mdi-content-save-settings-outline"></i> {{ __('Save') }}</x-primary-button>
                </div>
            </div> <!-- end col -->
        </div>

        <!-- <div class="flex items-center gap-4">
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div> -->
    </form>
</section>
