$('.view-btn').on('click', function() {
    var request_id = $(this).attr('id');

    // Send a request to the server to get the booking information
    $.ajax({
        url: '/requested/' + request_id,
        method: 'GET',
        success: function(data) {
            // Set the personal information in the modal
            $("#viewFullName").text(data.fullName);
            $("#viewEmail").text(data.email);
            $("#viewCpNo").text(data.cell_no);
            $("#viewSchoolID").text(data.school_id);
            $("#viewCourse").text(data.course);
            $("#viewStudentStatus").text(data.status);

            $("#viewAcadYear").text(data.acadYear);
            $("#viewGradYear").text(data.gradYear);
            if (data.acadYear === null) {
                $("#viewGradYearSect").show();
                $("#viewAcadYearSect").hide();
            }
            if (data.gradYear === null) {
                $("#viewAcadYearSect").show();
                $("#viewGradYearSect").hide();
            }
            $("#viewGender").text(data.gender);
            $("#viewCivilStats").text(data.civil_status);
            $("#viewBirthdate").text(data.birthdate);
            $("#viewAddress").text(data.address);

            // Set the personal information in the modal
            $("#viewAppID").text(data.booking_number);
            $("#viewDocDateReq").text(data.req_date);
            $("#viewDocName").text(data.doc_name);
            
            if(data.req_copies > 1){
                $("#viewCopyReq").text(data.req_copies + " copies");
            }else{
                $("#viewCopyReq").text(data.req_copies + " copy");
            }
            $("#viewDocReqYear").text(data.acad_year);
            if (data.doc_req_year === null) {
                $("#viewTOR").hide();
            } else {
                $("#viewTOR").show();
            }
            $("#viewPurpose").text(data.req_purpose);

            if (data.a_transfer == 0) {
                $("#viewATransfer").text("No");
            } else {
                $("#viewATransfer").text("No, " + data.a_transfer_school);
            }
            if (data.b_transfer == 0) {
                $("#viewBTransfer").text("No");
            } else {
                $("#viewBTransfer").text("No, " + data.b_transfer_school);
            }

            console.log(data.payment_method);

            if (data.payment_method === null) {
                $("#payment_sect_modal").hide();
            }else{
                $("#viewMethod").text(data.payment_method);
                $("#viewReferenceNumber").text(data.reference_number);
                $("#viewOfficialReceipt").attr("src", url + "/" + data.or_file_path);
                $("#downloadOfficialReceipt").attr("href", url + "/" + data.proof_of_payment);
                $("#viewOfficialReceiptPic").attr("href", url + "/" + data.proof_of_payment);

                if (data.payment_method === "Walk-in") {
                    $("#viewPopButton").hide();
                } else {
                    $("#viewPopButton").show();
                    $("#downloadProofOfPayment").attr("href", url + "/" + data.or_file_path);
                    $("#viewProofOfPaymentPic").attr("href", url + "/" + data.or_file_path);
                }
            }
            

            var requirements = data.requirements;

            if (requirements.length > 0) {
                $("#requirements_info_section").show();
                var requirementsHtml = '';
                data.requirements.forEach(function(requirement) {
                    var fileName = requirement.file_name;
                    var baseUrl = window.location.origin; // Get the base URL
                    var fileLink = baseUrl + '/' + requirement.file_path;
                    requirementsHtml += '<tr class="font-nun">';
                    requirementsHtml += '<td>' + fileName + '</td>';
                    requirementsHtml += '<td><a href="' + fileLink + '" target="_blank" class="btn btn-primary font-nun" style="background-color: #1e1e1e; color:white; border:none;">View</a></td>';
                    requirementsHtml += '</tr>';
                });
                $("#requirementsTable tbody").html(requirementsHtml);
            } else {
                $("#requirements_info_section").hide();
            }

            $("#view-request-modal").modal("show");
        },
        error: function(error) {
            console.log(error);
        }
    });
});
