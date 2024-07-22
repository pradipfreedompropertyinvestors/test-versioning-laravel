<section>
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header> -->

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="needs-validation">
        @csrf
        @method('patch')
        <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i> Personal Info</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="Enter first name" value="{{ $user->first_name }}">
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Enter last name" value="{{ $user->last_name }}">
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!-- end col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="username-addon">@</span>
                        </div>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter Username" value="{{ $user->username }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!-- end col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ $user->mobile_number }}">
                    @error('mobile_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!-- end col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gender" class="form-label"></label>
                    <div class="mt-3">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gender-male" name="gender" class="custom-control-input" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="gender-male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gender-female" name="gender" class="custom-control-input" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="gender-female">Female</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gender-other" name="gender" class="custom-control-input" value="Other" {{ $user->gender == 'Other' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="gender-other">Other</label>
                        </div>
                    </div>
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
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
