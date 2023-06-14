<div class="modal fade" id="addFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-nun font-white" id="addModalTitle">Add Form</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 font-nun">
                <form action="{{ route('create-form') }}" method="POST">
                    @csrf
                    <div class="d-flex flex-row justify-content-end flex-wrap">
                        <div class="d-flex flex-row">
                            <input class="form-check-input" id="ask_acad_year" type="checkbox" value="1" name="ask_acad_year" style="border: 2px solid #131313;">
                            <label class="form-check-label font-karma ms-2" for="ask_acad_year">
                                Asks for Academic Year
                            </label>
                        </div>
                        <div class="d-flex flex-row ms-4">
                            <input class="form-check-input" id="ask_requirements" type="checkbox" value="1" name="ask_requirements" style="border: 2px solid #131313;">
                            <label class="form-check-label font-karma ms-2" for="ask_requirements">
                                Asks for Requirements
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addFormName" class="form-label">Form Name</label>
                        <input type="text" class="form-control" name="name"  id="addFormName"  placeholder="Type Here . . .">
                    </div>
                    <div class="mb-3">
                        <label for="addAvailability" class="form-label">Availability of the Service</label>
                        <textarea class="form-control" name="form_avail" id="addAvailability" rows="3"  placeholder="Type Here . . ."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addAvailService" class="form-label">Who may Avail the Service</label>
                        <textarea class="form-control" name="form_who_avail" id="addAvailService" rows="3"  placeholder="Type Here . . ."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addReq" class="form-label">What are the Requirements</label>
                        <textarea class="form-control" name="form_requirements" id="addReq" rows="3"  placeholder="Type Here . . ."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addProcessingTime" class="form-label">Complete Processing Time</label>
                        <textarea class="form-control" name="form_process" id="addProcessingTime" rows="3"  placeholder="Type Here . . ."></textarea>
                    </div>
                    <div class="mb-3 form-group row">
                        <div class="col-md-3">
                            <label for="addDocFee" class="form-label">Document Fee</label>
                            <div class="d-flex flex-row align-items-center">   
                                <p class="p-0 m-0 me-2 font-bold">PHP </p>
                                <input type="number" class="form-control" style="flex: 1;" name="fee"  id="addDocFee" placeholder="ex. 50 or 0 for No Payment">
                                <p class="p-0 m-0 ms-2 font-bold"> .00</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="addDocFee" class="form-label">Collection Type</label>
                            <div class="d-flex flex-row align-items-center">
                                <input type="text" class="form-control" style="flex: 1;" name="fee_type"  id="addDocFeeType" placeholder="ex. Per Page, None or (Collected as part of graduation fee)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="addDocFee" class="form-label">Pages</label>
                            <div class="d-flex flex-row align-items-center">
                                <p class="p-0 m-0 me-2 font-bold">At least </p>
                                <input type="number" class="form-control" style="flex: 1;" name="pages"  id="addDocPages" placeholder="ex. 4">
                                <p class="p-0 m-0 ms-2 font-bold"> Page(s)</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addMaxTimeClaim" class="form-label">Maximum Time to Claim (After the request is filed)</label>
                        <textarea class="form-control" name="form_max_time" id="addMaxTimeClaim" rows="3"  placeholder="ex. 15 working days, 30 minutes"></textarea>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="bb btn btn-custom ms-3">Add Form</button>
                </div>
            </form>
        </div>
    </div>
</div>