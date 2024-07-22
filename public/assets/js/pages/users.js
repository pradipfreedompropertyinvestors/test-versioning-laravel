$(document).ready(function() {
    var table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/users', // Adjust the route URL as needed
            type: 'GET',
            data: function(d) {
                d.status = $('#statusFilter').val();
                d.role_id = $('#roleFilter').val();
            }
        },
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'name', name: 'name', orderable: false, searchable: false },
            { data: 'mobile_number', mobile_number: 'mobile_number' },
            { data: 'gender', name: 'gender' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    $('#statusFilter, #roleFilter').change(function() {
        table.draw();
    });

    $('#exportBtn').click(function () {
        var status = $('#statusFilter').val();
        var role_id = $('#roleFilter').val();
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $.ajax({
            url: '/users/export',
            method: 'GET',
            xhrFields: {
                responseType: 'blob' // Set the response type to blob
            },
            data: {
                status: status,
                role_id: role_id
            },
            success: function(response) {
                $('#exportBtn').prop('disabled', false).html('<i class="mdi mdi-export mr-2"></i><span>Export CSV</span>');
                // Create a blob URL for the response
                var blob = new Blob([response], { type: 'application/octet-stream' });
                var url = window.URL.createObjectURL(blob);

                // Create a temporary link element and trigger the download
                var a = document.createElement('a');
                a.href = url;
                a.download = 'users.csv'; // Or any other filename
                document.body.appendChild(a);
                a.click();

                // Clean up
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                console.log('Export successful');
            },
            error: function(xhr, status, error) {
                $('#exportBtn').prop('disabled', false).html('<i class="mdi mdi-export mr-2"></i><span>Export CSV</span>');
                console.error('Export failed:', error);
            }
        });
    });

    $('#userModal').on('hidden.bs.modal', function () {
        $('#id').val('');
        $('#userForm')[0].reset();
        // Clear error messages
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
    });

    $(document).on('click', '#add-user', function(e) {
        e.preventDefault();
        openModal('add', 'userModal', 'userForm');
    });
    
    // Event listener for edit buttons
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var userId = $(this).data('id');
        var editUrl = $(this).data('edit-url');
        var formFields = {
            'first_name': '#first_name',
            'last_name': '#last_name',
            'email': '#email',
            'username': '#username',
            'mobile_number': '#mobile_number',
            'status': '#status',
            'role_id': '#role_id',
            'gender': 'input[name="gender"]'
        };
        openModal('edit', 'userModal', 'userForm', userId, editUrl, formFields);
    });

    handleFormSubmit('btn-submit', 'userForm', 'userModal', function() {
        table.draw();
    });

    $(document).on('click', '.delete', function() {
        var userId = $(this).data('id');
        var url = 'users/' + userId;
        var token = $('meta[name="csrf-token"]').attr('content');
        showConfirmationAlert('Are you sure?', "You won't be able to revert this!", 'Yes, delete it!', 'No, cancel!')
        .then(function(result) {
            if (result.value) {
                deleteRecord(url, token, 'usersTable');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                showAlert('error', 'Your imaginary record is safe :)', 'Cancelled!');
            }
        });
    });

    

});