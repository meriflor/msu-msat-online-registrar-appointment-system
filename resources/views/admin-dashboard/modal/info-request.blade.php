<div
    class="modal fade modal-custom"
    id="info_request_modal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered modal-lg font-nun">
        <div class="modal-content modal-content-custom">
            <div class="modal-header fs-5 modal-header-custom">
                Request Information
            </div>
            <div class="modal-body px-5">
                <input type="hidden" id="request_id" name="request_id">
                <!-- <div class="d-flex flex-row"> -->
                <div class="mb-3">
                    <p class="font-bold">Name of Requester:</p>
                    <p class="px-3" id="req_fullName_text"></p>
                </div>
                <hr>
                <div class="mb-3">
                    <p class="font-bold">Document Requested:</p>
                    <p class="px-3 mb-0" id="req_doc_name_text"></p>
                    <small class="px-3" id="req_date_req_text"></small>
                </div>
                <hr>
                <div class="mb-3">
                    <p class="font-bold">Request Purpose:</p>
                    <p class="px-3" id="req_purpose_text"></p>
                </div>
                <hr>
                <div class="mb-3">
                    <p class="font-bold">Number of Copies:</p>
                    <p class="px-3" id="req_copies_text"></p>
                </div>
                <div class="mb-3" id="req_acad_year">
                    <hr>
                    <p class="font-bold">Academic Year:</p>
                    <p class="px-3" id="req_acad_year_text"></p>
                </div>
                <!-- </div> -->
                <div id="requirements_info_div">
                    <div class="p-info d-flex flex-column m-0 px-5 py-4 my-5">
                        <div class="p-info-head d-flex flex-row align-items-end" >
                            <div class="d-flex" style="width:30px; height:30px;">
                                <img class="w-100 h-100" src="/images/requirements_file.png" alt="requirments icon">
                            </div>
                            <p class="p-0 m-0 ms-2 font-nun fs-6 font-bold font-13" >
                                Requirements Uploaded
                            </p>
                        </div>
                        <table class="table font-nun" id="requirementsTable">
                            <thead>
                                <tr>
                                    <th scope="col">File Name</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h3 class="font-bold mb-2">Confirm Payment</h3>
                <div>
                    <input class="form-check-input" id="no_payment_check" type="checkbox" value="yes" name="no_payment_check" style="border: 2px solid #131313;">
                    <label class="form-check-label ms-2" for="no_payment_check">
                        No Payment
                    </label>
                </div>
                <div id="remarks_payment_div">
                    <label for="payment_remarks" class="mt-2">Payment Remarks:</label>
                    <textarea type="text" class="form-control" name="remarks_payment" id="remarks_payment" placeholder="ex. Your payment should be PHP 20.00"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-custom btn-modal-admin"
                    data-bs-dismiss="modal"
                    id="notify_dismiss"
                >
                    Dismiss
                </button>
                <button id="notify_payment" type="submit" class="btn btn-custom btn-modal-admin ms-2">
                    Notify
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#no_payment_check').on("change", function() {
        var isChecked = $(this).prop("checked");
        
        if (isChecked) {
            $('#remarks_payment_div').hide();
            $('#remarks_payment').val("");
        } else {
            $('#remarks_payment_div').show();
        }
    });
    $('#notify_dismiss').on("click", function() {
        $('#remarks_payment').val("");
        $('#no_payment_check').prop("checked", false);
        $('#remarks_payment_div').show();
    });
    $('#notify_payment').on("click", function() {
        var request_id = $('#request_id').val();
        var remarks, no_payment;
        var isChecked = $('#no_payment_check').prop("checked");
        
        if (isChecked) {
            remarks = "This document has no payment.";
            no_payment = 1;
        } else {
            remarks = $('#remarks_payment').val();
            no_payment = 0;
            console.log(remarks);
            if(remarks === null || remarks === ""){
                alert('Please input the payment.');
                return false;
            }
        }
        console.log(isChecked);
        console.log(remarks);

        // fix setting appointment,, sending to database then fetch to the handler side

        $.ajax({
            url: "{{ route('payment.confirm') }}",
            method: "POST",
            data: {
                request_id: request_id,
                remarks: remarks,
                no_payment: no_payment
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





    $('#submit_slot').on('click', function(event) {
        var slot_date = $('#slot_date').val();
        var slot = $('#available_slots').val();
        var disable = $('#disable_check').is(':checked');
        if(disable === true){
            disable = 1;
            slot = 0;
        }else{
            if(slot === null || slot === "" || slot === undefined){
                console.log('this is null');
                alert("Please enter a slot.");
                return false;
            }
            else if(slot == 0){
                disable = 1;
            }
            else{
                disable = 0;
            }
        }
        console.log("date: "+slot_date);
        console.log("slot: "+slot);
        console.log("disabled:"+disable);
        
        $.ajax({
            url: "{{ route('appointment_slots.store') }}",
            method: "POST",
            data: {
                slot_date: slot_date,
                available_slots: slot,
                disabled: disable
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
