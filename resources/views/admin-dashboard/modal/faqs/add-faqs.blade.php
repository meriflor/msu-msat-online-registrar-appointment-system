<!-- fix update modal -->
<form action="{{ route('faq-store') }}" method="POST">
    @csrf
<div
    class="modal fade"
    id="addFaqsModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="addModalTitle"
    aria-hidden="true">

    <div
        class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5 font-nun font-white"
                    id="addModalTitle"
                >
                    Post FAQs
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body px-5">
                <div class="mb-3">
                    <label for="addQuestion" class="form-label">Question</label>
                    <input
                        type="text"
                        class="form-control"
                        name="faqs_title"
                        id="addQuestion"
                        placeholder=""
                    />
                </div>
                <div class="mb-3">
                    <label for="addAnswer" class="form-label">Answer</label>
                    <textarea
                        class="form-control"
                        name="faqs_subtext"
                        id="addAnswer"
                        rows="5"
                    ></textarea>
                </div>
                <!-- <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggle-switch">
                    <label class="form-check-label" for="toggle-switch">Featured</label>
                </div> -->
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-custom"
                    data-bs-dismiss="modal"
                >
                Dismiss
                </button>
                <button type="submit" class="btn btn-custom ms-3">Add</button>
            </div>
        </div>
    </div>
</div>
</form>