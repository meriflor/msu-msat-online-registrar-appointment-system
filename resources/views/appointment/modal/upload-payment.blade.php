<div
    class="modal fade modal-custom"
    id="upload_payment_modal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered font-nun">
        <div class="modal-content modal-content-custom font-mont">
            <div class="modal-header fs-5 modal-header-custom">
                Payment
            </div>
            <div class="modal-body px-5">
                <input type="hidden" id="request_id" name="request_id">
                <input type="hidden" id="payment_id" name="payment_id">
                <div class="notice-box p-1 mb-2">
                    <p class="m-0"><span id="doc_fee"></span></p>
                </div>
                <div id="payment_section">
                    <div class="d-flex flex-column w-100 mb-3">
                        <p class="fs-4 font-mont font-bold">Payment Method</p>
                        <div>
                            <input type="radio" id="walk-in" name="payment_method" value="Walk-in">
                            <label for="walk-in">Walk-in</label>
                        </div>
                        <div>
                            <input type="radio" id="g-cash" name="payment_method" value="GCash">
                            <label for="gcash">G-Cash</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="gcash-sect">
                    <img src="/images/g-cash-temp.png" alt="">
                    <div class="d-flex flex-column w-100 my-3">
                        <label for="reference_number">Gcash Reference No.</label>
                        <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="Reference No.">
                    </div>
                    <input type="hidden" id="form_fee_val">
                    <div class="mt-3">
                        <label for="proof_of_payment" class="form-label">Upload the picture or screenshot of the proof of payment.</label>
                        <input class="form-control" type="file" id="proof_of_payment" name="proof_of_payment" accept=".jpg,.png,.jpeg,.svg">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-custom btn-modal-admin"
                    data-bs-dismiss="modal"
                    id="dismiss_payment"
                    style="border: solid #1e1e1e;"
                >
                    Dismiss
                </button>
                <button id="submit_payment" type="submit" class="btn btn-custom btn-modal-admin ms-2" style="border: solid #1e1e1e;">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.upload_payment_btn').on('click', function(){
        var app_id = $(this).data('app_id');
        var form_fee = $(this).data('form_fee');
        var payment_id = $(this).data('payment_id');
        console.log(form_fee);
        console.log(app_id+'click');
        console.log(payment_id+'click');
        $('#upload_payment_modal').modal('show');
        $('#upload_payment_modal').find('#request_id').val(app_id);
        $('#upload_payment_modal').find('#payment_id').val(payment_id);
        $('#upload_payment_modal').find('#doc_fee').text(form_fee);
    });

    $('#dismiss_payment').on('click', function(){
        $('input[name="payment_method"]').prop('checked', false);
        $('#reference_number').val('');
        $('input[type="file"]').val(null);
        $('#gcash-sect').hide();
    });

    $('#submit_payment').on('click', function(){
        var payment_method = $('input[name=payment_method]:checked').val();
        var proof_of_payment = $('#proof_of_payment')[0].files[0];
        var reference_number = $('#reference_number').val();
        var request_id = $('#request_id').val();
        var payment_id = $('#payment_id').val();
        if(payment_method === undefined){
            alert('Please fill up the provided inputs.');
            return false;
        }if(payment_method === "GCash" && (reference_number === null || reference_number === "" || reference_number === undefined)){
            alert('Please type your reference number from your proof of payment.');
            return false;
        }if(payment_method === "GCash" && proof_of_payment === undefined){
            alert('Please upload your proof of payment.');
            return false;
        }

        console.log(payment_method);
        console.log(reference_number);
        console.log(proof_of_payment);
        console.log(request_id);
        console.log(payment_id);

        var formData = new FormData();
        formData.append('payment_method', payment_method);
        formData.append('proof_of_payment', proof_of_payment);
        formData.append('reference_number', reference_number);
        formData.append('request_id', request_id);
        formData.append('payment_id', payment_id);

        $.ajax({
            url: "{{ route('payment.upload') }}",
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-HTTP-Method-Override': 'PUT' // Set the request method to PUT
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
