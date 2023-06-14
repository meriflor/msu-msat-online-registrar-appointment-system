<div class="modal fade" id="cancelAppointmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content modal-dialog-confirm modal-confirm-padding text-center">
            <!-- <div class="modal-body"> -->
                <input type="hidden" id="app_id">
                <p class="h5 font-bold-font-mont">Are you sure you want to cancel your appointment?</p>
                <div class="d-flex flex-row justify-content-center">
                    <a type="button" class="btn btn-confirm mt-3" data-bs-dismiss="modal">Dismiss</a>
                <a type="button" class="btn btn-confirm mt-3 ms-3" id="cancel_app_confirm">
                    Confirm
                </a>
                </div>
                
            <!-- </div> -->
        </div>
    </div>
</div>

<script> 
    $('.cancel_app').click(function(){
        var app_id = $(this).data('app-id');
        $('#app_id').val(app_id);
        console.log(app_id);
    });

    $('#cancel_app_confirm').click(function(){
        var app_id =  $('#app_id').val();
        console.log(app_id);
        
        $.ajax({
            type: 'DELETE',
            url: "appointment/delete/" + app_id,
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr) {
                // handle error response
            }
        });
    })
</script>
