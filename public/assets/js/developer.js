function showAlert(alertType, message, title="Success") {
    Swal.fire( {
        title: title,
        text: message,
        type: alertType,
        showConfirmButton: false,
        timer: 1500
    })
}

function showConfirmationAlert(title, text, confirmButtonText, cancelButtonText) {
    return Swal.fire({
        title: title,
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ml-2 mt-2',
        buttonsStyling: false
    });
}

// Open Edit Modal
function openModal(mode, modalName, formId, recordId = null, editUrl = null, formFields = {}) {
    // Set mode (add or edit)
    var isEdit = mode === 'edit';
    // Clear form fields
    $('#' + formId)[0].reset();
    // Update modal title based on mode
    $('#' + modalName + ' .modal-title').text(isEdit ? 'Edit Record' : 'Add Record');
    // Set record ID in form for editing
    if (isEdit) {
        $('#' + formId + ' input[name="id"]').val(recordId);
        // Fetch record data via AJAX for edit mode
        $.ajax({
            url: editUrl, // Replace with your endpoint to fetch record details
            type: 'GET',
            success: function(response) {
                // Populate form fields with record data
                Object.keys(formFields).forEach(function(field) {
                    if (field === 'gender') {
                        $('#' + formId + ' input[name="gender"][value="' + response[field] + '"]').prop('checked', true);
                    } else {
                        $('#' + formId + ' ' + formFields[field]).val(response[field]);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error (e.g., display error message)
            }
        });
    }
    // Open the modal
    $('#' + modalName).modal('show');
}

// Form Submit
function handleFormSubmit(buttonId, formId, modalId, reloadFunction) {
    $(`#${buttonId}`).on('click', function(e) {
        e.preventDefault();
        
        var form = $(`#${formId}`);
        var formData = form.serialize();
        var url = form.attr('action');

        var isEdit = form.find('#id').val() !== '';

        if (isEdit) {
            var editRoute = form.data('edit-route');
            url = editRoute.replace(':recordId', form.find('#id').val());
        }

        $.ajax({
            url: url,
            type: isEdit ? 'PUT' : 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.success);
                    $(`#${modalId}`).modal('hide');
                    form[0].reset();
                    $('.invalid-feedback').text('');
                    $('.form-control').removeClass('is-invalid');
                }
                reloadFunction();
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                if (errors) {
                    $('.invalid-feedback').text('');
                    $('.form-control').removeClass('is-invalid');
                    $.each(errors, function(key, value) {
                        $(`#${key}`).addClass('is-invalid');
                        $(`#${key}_error`).text(value[0]);
                    });
                }
                if(isEdit)
                    showAlert('error', 'Failed to update record. Please check the form fields.');
                else
                    showAlert('error', 'Failed to add record. Please check the form fields.');
            }
        });
    });
}

function deleteRecord(url, token, dataTableId) {
    $.ajax({
        url: url, 
        type: 'DELETE',
        data: { _token: token },
        success: function(response) {
            reloadDataTable(dataTableId);
            showAlert('success', response.success, 'Deleted!');
        },
        error: function(xhr, status, error) {
            showAlert('error', 'Failed to delete item. Please try again.', 'Error');
        }
    });
}

function reloadDataTable(dataTableId) {
    $('#'+dataTableId).DataTable().ajax.reload();
}

// $(document).ready(function() {
    
// });