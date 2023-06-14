<form action="{{ route('store-course') }}" method="POST">
    @csrf
<div class="modal fade" id="addCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-nun font-white" id="addCourseModalTitle">Add Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <div class="mb-3">
                    <label for="addCourseName" class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="course_name" id="addCourseName" placeholder="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Dismiss</button>
                <button type="submit" class="btn btn-custom ms-3">Add</button>
            </div>
        </div>
    </div>
</div>
</form>