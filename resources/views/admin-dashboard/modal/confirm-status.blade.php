<div class="modal fade" id="status_appointment_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-white font-nun" id="status_title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-doc font-nun text-center font-bold">
                <input type="hidden" id="app_id" name="app_id" value="">
                <input type="hidden" id="accept_status" name="accept_status" value="On Process">
                <input type="hidden" id="done_status" name="done_status" value="Ready to Claim">
                <input type="hidden" id="claimed_status" name="claimed_status" value="Claimed">
                
                <p class="m-0 p-0" id="status_body"></p>

                <!-- review this is for the ready to claim section where they have to update the status or they have to notify the user to set up their appointment -->
                <div id="readytoclaim_sect">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="text-start d-flex flex-column justify-content-center" style="width:max-content;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="readytoclaim_check" id="setAppCheck" value="setAppointment" checked>
                                <label class="form-check-label" for="setAppCheck">
                                    Set an Appointment
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="readytoclaim_check" id="claimCheck" value="claimed">
                                <label class="form-check-label" for="claimCheck">
                                    Claimed
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" id="acceptApp" style="display:none;" class="btn btn-custom ms-3">Confirm</button>
                <button type="submit" id="doneApp" style="display:none;" class="btn btn-custom ms-3">Confirm</button>
                <button type="submit" id="claimedApp" style="display:none;" class="btn btn-custom ms-3">Confirm</button>
            </div>
        </div>
    </div>
</div>
