var editAnnouncements = document.querySelectorAll(
    ".open_edit_announcement_modal"
);
for (var i = 0; i < editAnnouncements.length; i++) {
    editAnnouncements[i].addEventListener("click", function () {
        console.log("this is clicked");
        var announcement_id = $(this).data("announcement-edit-id");
        console.log(announcement_id);
        $("#editAnnouncementModal").modal("show");
        $("#announcement-id").val(announcement_id);

        fetch("/announcement/" + announcement_id)
            .then((response) => response.json())
            .then((data) => {
                $("#editATitle").val(data.announcement_title);
                $("#editAPost").text(data.announcement_text);
            });
    });
}

var deleteAnnouncements = document.querySelectorAll(
    ".open_delete_announcement_modal"
);
for (var i = 0; i < deleteAnnouncements.length; i++) {
    deleteAnnouncements[i].addEventListener("click", function () {
        var announcement_id = $(this).data("announcement-delete-id");
        var announcement_name = $(this).data("announcement-delete-name");
        console.log(announcement_id);
        console.log(announcement_name);
        $("#deleteAnnouncementModal").modal("show");
        $("#deleteAnnouncementModal #announcement-id_delete").val(
            announcement_id
        );
        $("#deleteAnnouncementModal #announcementName").text(announcement_name);
    });
}
