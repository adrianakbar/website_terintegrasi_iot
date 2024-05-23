$(document).ready(function() {
    $('.ukurancheckbox').on('change', function() {
        var isChecked = $(this).is(':checked');
        var taskId = $(this).data('id'); // Assumes you have a data-id attribute with task id
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var checkboxValue = isChecked ? 1 : 0;

        console.log('Task ID:', taskId);

        Swal.fire({
            title: 'Ubah Status Tugas',
            text: "Apakah Anda yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#515646',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/updatecheckbox',
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        id_tugas: taskId,
                        checkbox: checkboxValue
                    },
                    success: function(response) {
                        Swal.fire(
                            'Updated!',
                            'The task status has been updated.',
                            'success'
                        );
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'There was an error updating the task status.',
                            'error'
                        );
                    }
                });
            } else {
                // If user cancels, revert the checkbox state
                $(this).prop('checked', !isChecked);
            }
        });
    });
});
