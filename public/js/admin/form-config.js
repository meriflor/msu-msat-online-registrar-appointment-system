var editForms = document.querySelectorAll(".open_edit_form_modal");
for (var i = 0; i < editForms.length; i++) {
    editForms[i].addEventListener("click", function () {
        var form_id = $(this).data("form-edit-id");
        console.log(form_id);
        $("#editFormModal").modal("show");
        $("#form-id").val(form_id);

        fetch("/form/" + form_id)
            .then((response) => response.json())
            .then((data) => {
                $("#editFormName").val(data.name);
                $("#editAvailability").text(data.form_avail);
                $("#editAvailService").text(data.form_who_avail);
                $("#editReq").text(data.form_requirements);
                $("#editProcessingTime").text(data.form_process);
                $("#editDocFee").val(data.fee);
                $("#editMaxTimeClaim").text(data.form_max_time);
                $("#editDocFeeType").val(data.fee_type);
                $("#editDocPages").val(data.pages);
                if(data.acad_year == 1){
                    $("#edit_ask_acad_year").prop("checked", true);
                }else{
                    $("#edit_ask_acad_year").prop("checked", false);
                }if(data.requirements == 1){
                    $("#edit_ask_requirements").prop("checked", true);
                }else{
                    $("#edit_ask_requirements").prop("checked", false);
                }
            });
    });
}

var deleteForms = document.querySelectorAll(".open_delete_form_modal");
for (var i = 0; i < deleteForms.length; i++) {
    deleteForms[i].addEventListener("click", function () {
        var form_id = $(this).data("form-delete-id");
        var form_name = $(this).data("form-delete-name");
        console.log(form_id);
        console.log(form_name);
        $("#deleteFormModal").modal("show");
        $("#deleteFormModal #form-id_delete").val(form_id);
        $("#deleteFormModal #formName").text(form_name);
    });
}

var editCourses = document.querySelectorAll(".open_edit_course_modal");
for (var i = 0; i < editCourses.length; i++) {
    editCourses[i].addEventListener("click", function () {
        var course_id = $(this).data("course-edit-id");
        var course_name = $(this).data("course-edit-name");
        console.log(course_id);
        $("#editCourseModal").modal("show");
        $("#course-id").val(course_id);
        $("#editCourseName").val(course_name);
    });
}

var deleteCourses = document.querySelectorAll(".open_delete_course_modal");
for (var i = 0; i < deleteCourses.length; i++) {
    deleteCourses[i].addEventListener("click", function () {
        var course_id = $(this).data("course-delete-id");
        var course_name = $(this).data("course-delete-name");
        console.log(course_id);
        console.log(course_name);
        $("#deleteCourseModal").modal("show");
        $("#deleteCourseModal #course-id_delete").val(course_id);
        $("#deleteCourseModal #courseName").text(course_name);
    });
}
