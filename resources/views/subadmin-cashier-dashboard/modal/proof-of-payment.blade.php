<div class="modal fade" id="proof_of_payment_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title  fs-5 font-white font-nun" id="staticBackdropLabel">Proof of Payment</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="font-nun alert alert-success" id="viewConfirmedPayment">
                <p class="m-0 p-0"><b>Confirmed Payment Remarks: </b><span id="confirmedPayment"></span></p>
            </div>
            <div class="font-nun alert alert-dark" id="viewRefenceNum">
                <p class="m-0 p-0"><b>Reference Number: </b><span id="referenceNum"></span></p>
            </div>
            <div class="row w-100 p-0 my-2" id="viewPopImage">
                <div class="payment-method d-flex flex-row justify-content-center">
                    <img
                        src=""
                        alt=""
                        id="viewProofOfPayment_cashier"
                    />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-custom" id="pop_new_tab">Open New Tab</button>
            <button type="button" class="btn btn-custom ms-2" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>