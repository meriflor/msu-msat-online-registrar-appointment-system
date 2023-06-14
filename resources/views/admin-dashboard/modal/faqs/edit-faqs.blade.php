<div class="modal fade" id="editFaqsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editFaqsModal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun" id="editFaqsModal">
                    Edit Post
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <input type="hidden" id="faq-id">
                <div class="mb-3">
                    <label for="editQuestion" class="form-label">Question</label>
                    <input
                        type="text"
                        class="form-control"
                        name="editQuestion"
                        id="editQuestion"
                        placeholder=""
                    />
                </div>
                <div class="mb-3">
                    <label for="editAnswer" class="form-label">Answer</label>
                    <textarea
                        class="form-control"
                        name="editAnswer"
                        id="editAnswer"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-custom"
                    data-bs-dismiss="modal"
                >
                Dismiss
                </button>
                <button type="submit" class="btn btn-custom ms-3" id="submit_faq_update">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#submit_faq_update').on('click', function(){
        var faqID = $('#faq-id').val();
        var editQuestion = $('#editQuestion').val();
        var editAnswer = $('#editAnswer').val();

        $.ajax({
            url: "{{ route('editfaq') }}",
            method: "PUT",
            data: {
                faqID: faqID,
                editQuestion: editQuestion,
                editAnswer: editAnswer,
            },
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