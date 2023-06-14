<div class="modal fade" id="deleteFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFormModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun">Delete Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body font-nun px-5 text-center">
                <input type="hidden" id="form-id_delete">
                <p class="m-0 p-0">You are about to delete the</p>
                <b id="formName">Issuance of Transcript of Records (TOR)</b>
                <p class="m-0 p-0"> Are you sure to delete this form?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Dismiss</button>
                <button type="submit" class="btn btn-custom ms-3" id="submit_delete_form">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#submit_delete_form').on('click', function(){
        var formID = $('#form-id_delete').val();
        $.ajax({
            url: "{{ route('deleteform', '') }}/" + formID,
            type: 'DELETE',
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        }); 
    });
</script>
