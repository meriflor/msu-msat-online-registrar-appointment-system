<div class="modal fade" id="editCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCourseModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-nun font-white" id="editCourseModalTitle">Edit Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <input type="hidden" id="course-id">
                <div class="mb-3">
                    <label for="editCourseName" class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="editCourseName" id="editCourseName" placeholder="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Dismiss</button>
                <button type="submit" class="btn btn-custom ms-3" id="submit_course_update">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#submit_course_update').on('click', function(){
        var courseID = $('#course-id').val();
        var editCourseName = $('#editCourseName').val();

        $.ajax({
            url: "{{ route('editcourse') }}",
            method: "PUT",
            data: {
                courseID: courseID,
                editCourseName: editCourseName,
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