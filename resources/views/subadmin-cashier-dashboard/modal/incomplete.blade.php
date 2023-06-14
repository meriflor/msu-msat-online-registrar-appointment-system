<div class="modal fade" id="incomplete_payment_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun">Incomplete Payment</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('payment-status-update') }}" method="post">
                @csrf
                <div class="modal-body modal-doc font-nun text-center font-bold p-4">
                    <input type="hidden" id="app_id" name="app_id" value="">
                    <input type="hidden" name="payment_status" value="incomplete">
                    <div class="form-group d-flex flex-column align-items-start">
                        <label for="remarks">Remarks: </label>
                        <textarea type="text" class="form-control" name="remarks" id="remarks" placeholder="ex.You need to pay 25 pesos more." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="" class="btn btn-custom ms-3">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>