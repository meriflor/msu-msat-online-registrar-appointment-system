<!-- fix delete -->
<div class="modal fade" id="deleteAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteAnnouncementModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 font-white font-nun">Delete Announcement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body font-nun px-5 text-center">
                    <input type="hidden" id="announcement-id_delete">
                    <p class="m-0 p-0"> Are you sure you want to delete this announcement?</p>
                    <b id="announcementName">Issuance of Transcript of Records (TOR)</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-custom ms-3" id="submit_delete_announcement">Delete</button>
                </div>
            </div>
        </div>
    </div>

    
<script>
    $('#submit_delete_announcement').on('click', function(){
        var announcementID = $('#announcement-id_delete').val();
        $.ajax({
            url: "{{ route('deleteannouncement', '') }}/" + announcementID,
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
