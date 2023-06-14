$(document).ready(function () {
    $("#reg-input-gradYear").hide();
    $("#inputStudentStatus").change(function () {
        // if ($(this).val() === "senior_high_graduate" ||$(this).val() === "undergraduate_alumni" ||$(this).val() === "masteral_alumni") {
            if($(this).val() === "High School Graduate (Before K-12)" ||
            $(this).val() === "Senior High School Graduate" ||
            $(this).val() === "College Graduate" ||
            $(this).val() === "Master's Degree Graduate"){
            $("#reg-input-acadYear").hide();
            // $('#reg-input-acadYear').removeAttr('required');
            $("#reg-input-gradYear").show();
            // $('#reg-input-gradYear').attr('required', 'required');
        } else {
            $("#reg-input-gradYear").hide();
            // $('#reg-input-gradYear').removeAttr('required');
            $("#reg-input-acadYear").show();
            // $('#reg-input-acadYear').attr('required', 'required');
        }
    });
});

// fix
$(document).ready(function () {
    $("#editStatus").change(function () {
        // if ($(this).val() === "senior_high_graduate" ||$(this).val() === "undergraduate_alumni" ||$(this).val() === "masteral_alumni") {
            if($(this).val() === "High School Graduate (Before K-12)" ||
            $(this).val() === "Senior High School Graduate" ||
            $(this).val() === "College Graduate" ||
            $(this).val() === "Master's Degree Graduate"){
            $("#edit-AcadYear").hide();
            $("#edit-GradYear").show();
        } else {
            $("#edit-GradYear").hide();
            $("#edit-AcadYear").show();
        }
    });
    // var status = $("#editStatus").val();
    // if ($("#editStatus").val() === "senior_high_graduate" ||$("#editStatus").val() === "undergraduate_alumni" ||$("#editStatus").val() === "masteral_alumni") {
    if($("#editStatus").val() === "High School Graduate (Before K-12)" ||
        $("#editStatus").val() === "Senior High School Graduate" ||
        $("#editStatus").val() === "College Graduate" ||
        $("#editStatus").val() === "Master's Degree Graduate"){
        $("#edit-AcadYear").hide();
        $("#edit-GradYear").show();
    } else {
        $("#edit-GradYear").hide();
        $("#edit-AcadYear").show();
    }
});

$(document).ready(function () {
    $("input[name=payment_method]").change(function () {
        if ($(this).val() === "GCash") {
            $("#gcash-sect").show();
        } else {
            $("#gcash-sect").hide();
        }
    });
});

$(document).ready(function () {
    // var status = $("#inputStudentStatus").val();
    if($("#inputStudentStatus").val() === "High School Graduate (Before K-12)" ||
        $("#inputStudentStatus").val() === "Senior High School Graduate" ||
        $("#inputStudentStatus").val() === "College Graduate" ||
        $("#inputStudentStatus").val() === "Master's Degree Graduate"){
        $("#input-acadYear").hide();
        $("#input-gradYear").show();
    } else {
        $("#input-gradYear").hide();
        $("#input-acadYear").show();
    }
});

$(document).ready(function () {
    $("input[name=isATransfer]").change(function () {
        if ($(this).val() === "Yes") {
            $("#ATransferSchool").show();
        } else {
            $("#ATransferSchool").hide();
        }
    });
    $("input[name=isBTransfer]").change(function () {
        if ($(this).val() === "Yes") {
            $("#BTransferSchool").show();
        } else {
            $("#BTransferSchool").hide();
        }
    });
});
