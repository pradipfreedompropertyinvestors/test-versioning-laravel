$(document).ready(function() {
    var table = $('#subdistrictsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/subdistricts',
            type: 'GET',
            data: function(d) {
                d.status = $('#statusFilter').val(),
                d.state_id = $('#stateFilter').val()
            }
        },
        columns: [
            { data: 'subdistrict_name', name: 'subdistrict_name' },
            { data: 'subdistrict_code', name: 'subdistrict_code' },
            { data: 'district_name', name: 'district_name' },
            { data: 'state_name', name: 'state_name' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
    });

    $(document).on('click', '#add-district', function(e) {
        e.preventDefault();
        openModal('add', 'districtModal', 'districtForm');
    });
    
    handleFormSubmit('btn-submit', 'districtForm', 'districtModal', function() {
        reloadDataTable('districtsTable'); // Function to reload your data table
    });

    $(document).on('click', '.delete', function() {
        var districtId = $(this).data('id');
        var url = 'districts/' + districtId;
        var token = $('meta[name="csrf-token"]').attr('content');
        showConfirmationAlert('Are you sure?', "You won't be able to revert this!", 'Yes, delete it!', 'No, cancel!')
        .then(function(result) {
            if (result.value) {
                deleteRecord(url, token, 'districtsTable');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                showAlert('error', 'Your imaginary record is safe :)', 'Cancelled!');
            }
        });
    });

    $('#statusFilter, #stateFilter').change(function() {
        table.draw();
    });

    // Event listener for edit buttons
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var districtId = $(this).data('id');
        var editUrl = $(this).data('edit-url');
        var formFields = {
            'district_name': '#district_name',
            'district_code': '#district_code',
            'state_id': '#state_id',
            'status': '#status',
        };
        openModal('edit', 'districtModal', 'districtForm', districtId, editUrl, formFields);
    });

    $('#stateModal').on('hidden.bs.modal', function () {
        $('#id').val('');
        $('#stateForm')[0].reset();
        // Clear error messages
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
    });
});