<div class="modal fade" id="remarks_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun">Remarks</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('appointmentremarks') }}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body modal-doc font-nun font-bold">
                    <input type="hidden" id="app_id" name="app_id" value="">
                    <input type="hidden" id="notif_type" name="notif_type" value="remarks">
                    <input type="hidden" id="doc" name="doc" value="">
                    <!-- review for now setting the resched as 0 to avoid error -->
                    <!-- <input type="hidden" id="resched" name="resched_check" value="0"> -->
                    <div class="d-flex flex-row align-items-center mb-3 row">
                        <div class="col-md-6">
                            <p class="p-0 m-0">To: <span id="last_name"></span>, <span id="first_name"></span></p>
                        </div>
                        <!-- <div class="col-md-6 d-flex flex-row justify-content-end">
                            <input class="form-check-input" id="resched_check" type="checkbox" value="1" name="resched_check" style="border: 2px solid #131313;">
                            <label class="form-check-label font-karma ms-2" for="resched_check">
                                Re-schedule
                            </label>
                        </div> -->
                    </div>

                    <div class="d-flex flex-row align-items-center mb-3 row">
                        <div class="col-md-6">
                            <p class="m-0 me-2 font-bold">Title: </p>
                            <select class="form-select" name="title" aria-label="Default select example">
                                <option value="Additional information:" selected>Additional information:</option>
                                <option value="Important notes:">Important notes:</option>
                                <option value="Required documents:">Required documents:</option>
                                <option value="Reminder details:">Reminder details:</option>
                                <option value="Follow-up instructions:">Follow-up instructions:</option>
                                <option value="Next steps:">Next steps:</option>
                                <!-- <option value="Appointment Cancellation">Appointment Cancellation:</option> -->
                                <!-- <option value="Appointment Rescheduling Request">Rescheduling Request:</option> -->
                                <option value="Re-upload Requirements Request:">Re-upload Requirements Request:</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <p class="m-0 me-2 font-bold">Document Requested: </p>
                            <p class="m-0 me-2" id="doc_name"></p>
                        </div>
                    </div>
                    
                    <textarea class="form-control" name="remarks" id="remarks" placeholder="Type here..." style="height:150px;" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-custom ms-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin/appointment/remarks.js') }}"></script>