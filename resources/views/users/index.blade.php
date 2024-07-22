<x-app-layout>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">User Management</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end my-3">
                        <div class="col-md-8">
                            <div class="dt-buttons btn-group mb-3">
                                <button class="btn btn-primary waves-effect waves-light" type="button" id="add-user"><i class="mdi mdi-account-plus-outline mr-2"></i><span>Add New</span></button>
                            </div>
                            <div class="dt-buttons btn-group mb-3">
                                <button class="btn btn-primary waves-effect waves-light" id="exportBtn" type="button"><i class="mdi mdi-export mr-2"></i><span>Export CSV</span></button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select id="statusFilter" class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="roleFilter" class="form-control">
                                <option value="">All Roles</option>
                                @if(isset($roles) && !empty($roles))
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <table id="usersTable" class="table table-striped dt-responsive nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    <div id="userModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <x-primary-button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </x-primary-button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="{{ route('users.store') }}" data-add-route="{{ route('users.store') }}" data-edit-route="{{ route('users.update', ':recordId') }}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" :value="old('first_name')" class="form-control @error('first_name') is-invalid @enderror" id="first_name">
                            <div class="invalid-feedback" id="first_name_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" :value="old('last_name')" class="form-control @error('last_name') is-invalid @enderror" id="last_name">
                            <div class="invalid-feedback" id="last_name_error"></div>
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male">
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female">
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_other" value="Other">
                                <label class="form-check-label" for="gender_other">Other</label>
                            </div>
                            <div class="invalid-feedback d-block" id="gender_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile</label>
                            <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number">
                            <div class="invalid-feedback" id="mobile_number_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username">
                            <div class="invalid-feedback" id="username_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                            <div class="invalid-feedback" id="email_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            <div class="invalid-feedback" id="password_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Roles</label>
                            <select class="form-control" id="role_id" name="role_id">
                                <option value="">Select Role</option>
                                @if(isset($roles) && !empty($roles))
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback" id="role_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="invalid-feedback" id="status_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <x-primary-button class="btn btn-danger waves-effect waves-light mt-2" data-dismiss="modal"><i class="mdi mdi-close-box-outline"></i> {{ __('Close') }}</x-primary-button>
                    <x-primary-button class="btn btn-success waves-effect waves-light mt-2" id="btn-submit"><i class="mdi mdi-content-save-settings-outline"></i> {{ __('Save') }}</x-primary-button>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container-fluid -->
</x-app-layout>