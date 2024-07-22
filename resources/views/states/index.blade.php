<x-app-layout>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">States Management</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end my-3">
                        <div class="col-md-10">
                            <div class="dt-buttons btn-group mb-3">
                                <button class="btn btn-primary waves-effect waves-light" type="button" id="add-state"><i class="mdi mdi-account-plus-outline mr-2"></i><span>Add New</span></button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select id="statusFilter" class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <table id="statesTable" class="table table-striped dt-responsive nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th>State Name</th>
                            <th>State Code</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
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
    <div id="stateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New State</h5>
                    <x-primary-button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </x-primary-button>
                </div>
                <div class="modal-body">
                    <form id="stateForm" action="{{ route('states.store') }}" data-add-route="{{ route('states.store') }}" data-edit-route="{{ route('states.update', ':recordId') }}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="state_name">State Name</label>
                            <input type="text" name="state_name" class="form-control @error('state_name') is-invalid @enderror" id="state_name">
                            <div class="invalid-feedback" id="state_name_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="state_code">State Code</label>
                            <input type="text" name="state_code" class="form-control @error('state_code') is-invalid @enderror" id="state_code">
                            <div class="invalid-feedback" id="state_code_error"></div>
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