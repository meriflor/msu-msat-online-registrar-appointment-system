<div
    class="modal fade"
    id="deleteFaqsModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteFaqsModal"
    aria-hidden="true"
                     >
    <div
        class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5 font-white font-nun"
                    id="deleteFaqsModal"
                >
                    Delete Post
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body font-nun px-5 text-center">
                <input type="hidden" id="faq-id_delete">
                <p class="m-0 p-0">Are you sure to delete this post?</p>
                <b id="faqName">"How to make an Appointment?"</b>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-custom"
                    data-bs-dismiss="modal"
                >
                Dismiss
                </button>
                <button type="submit" class="btn btn-custom ms-3" id="submit_delete_faq">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#submit_delete_faq').on('click', function(){
        var faqID = $('#faq-id_delete').val();
        $.ajax({
            url: "{{ route('deletefaq', '') }}/" + faqID,
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