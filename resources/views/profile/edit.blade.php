<x-app-layout>

    <div class="row">
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-1 mt-2">{{ $user->first_name }} {{ $user->last_name }}</h4>
                    <p class="text-muted">{{ $user->role->name }}</p>

                    <div class="text-start mt-3" style="text-align: left;">
                        <p class="text-muted mb-2"><strong>Gender :</strong> <span class="ms-2 ">{{ $user->gender }}</span></p>
                        <p class="text-muted mb-2"><strong>Mobile :</strong><span class="ms-2">{{ $user->mobile_number }}</span></p>
                        <p class="text-muted mb-2"><strong>Email :</strong> <span class="ms-2 ">{{ $user->email }}</span></p>
                    </div>

                </div> <!-- end card-body -->
            </div>
            <!--end card-->
        </div><!-- end col -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <!--end card body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-body">

                </div> <!-- end card-body -->
            </div>
            <!--end card-->
        </div><!-- end col -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
                <!--end card body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    

    <!-- <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> -->
    
</x-app-layout>
