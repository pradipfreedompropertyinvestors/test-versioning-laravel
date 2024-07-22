$(document).ready(function() {
    $('#rolesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/roles',
            type: 'GET'
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
    });

    $(document).on('click', '#add-role', function(e) {
        e.preventDefault();
        openModal('add', 'roleModal', 'roleForm');
    });
    
    handleFormSubmit('btn-submit', 'roleForm', 'roleModal', function() {
        reloadDataTable('rolesTable'); // Function to reload your data table
    });

    $(document).on('click', '.delete', function() {
        var roleId = $(this).data('id');
        var url = 'roles/' + roleId;
        var token = $('meta[name="csrf-token"]').attr('content');
        showConfirmationAlert('Are you sure?', "You won't be able to revert this!", 'Yes, delete it!', 'No, cancel!')
        .then(function(result) {
            if (result.value) {
                deleteRecord(url, token, 'rolesTable');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                showAlert('error', 'Your imaginary record is safe :)', 'Cancelled!');
            }
        });
    });

    // Event listener for edit buttons
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var roleId = $(this).data('id');
        var editUrl = $(this).data('edit-url');
        var formFields = {
            'name': '#name',
            'status': '#status',
        };
        openModal('edit', 'roleModal', 'roleForm', roleId, editUrl, formFields);
    });

    $('#roleModal').on('hidden.bs.modal', function () {
        $('#id').val('');
        $('#roleForm')[0].reset();
        // Clear error messages
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
    });
});