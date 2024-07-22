$(document).ready(function() {
    var table = $('#statesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/states',
            type: 'GET',
            data: function(d) {
                d.status = $('#statusFilter').val();
            }
        },
        columns: [
            { data: 'state_name', name: 'state_name' },
            { data: 'state_code', name: 'state_code' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
    });

    $(document).on('click', '#add-state', function(e) {
        e.preventDefault();
        openModal('add', 'stateModal', 'stateForm');
    });
    
    handleFormSubmit('btn-submit', 'stateForm', 'stateModal', function() {
        reloadDataTable('statesTable'); // Function to reload your data table
    });

    $(document).on('click', '.delete', function() {
        var stateId = $(this).data('id');
        var url = 'states/' + stateId;
        var token = $('meta[name="csrf-token"]').attr('content');
        showConfirmationAlert('Are you sure?', "You won't be able to revert this!", 'Yes, delete it!', 'No, cancel!')
        .then(function(result) {
            if (result.value) {
                deleteRecord(url, token, 'statesTable');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                showAlert('error', 'Your imaginary record is safe :)', 'Cancelled!');
            }
        });
    });

    $('#statusFilter').change(function() {
        table.draw();
    });

    // Event listener for edit buttons
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var stateId = $(this).data('id');
        var editUrl = $(this).data('edit-url');
        var formFields = {
            'state_name': '#state_name',
            'state_code': '#state_code',
            'status': '#status',
        };
        openModal('edit', 'stateModal', 'stateForm', stateId, editUrl, formFields);
    });

    $('#stateModal').on('hidden.bs.modal', function () {
        $('#id').val('');
        $('#stateForm')[0].reset();
        // Clear error messages
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
    });
});