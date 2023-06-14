<!-- fix update modal -->
<form action="{{ route('announcement-store') }}" method="POST">
        @csrf

    <div class="modal fade" id="addAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAnnouncementModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 font-white font-nun" id="addAnnouncementModal">Post Announcement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5">
                    <div class="mb-3">
                        <label for="addATitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="announcement_title" id="addATitle" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="addAPost" class="form-label">Announcement</label>
                        <textarea class="form-control" name="announcement_text" id="addAPost" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-custom ms-3">Post</button>
                </div>
            </div>
        </div>
    </div>
</form>