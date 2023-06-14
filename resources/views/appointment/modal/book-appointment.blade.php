<div class="modal fade" id="appointmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="form_name"></h1>
            <button type="button" class="btn-close btn-close-white dismissButton" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body font-mont">
            <input type="hidden" name="form_id" id="form_id">
            <input type="hidden" name="form_acad_year" id="form_acad_year">
            <input type="hidden" name="form_requirements" id="form_requirements">
            <div class="mb-3">
                <label for="app_purpose">Purpose: </label>
                <textarea placeholder="Enter your purpose here" class="form-control" id="app_purpose" name="app_purpose" style="height: 150px;" type="text" placeholder="" aria-label="default input example"></textarea>
            </div>
            <div class="mb-3" id="app-acad-year">
                <label for="inputDocAcadYear">Academic Year: </label>
                <input class="form-control" type="text" name="acad_year" id="acad_year" placeholder="Academic Year" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="num_copies">Number of Copy: </label>
                <select class="form-control" name="num_copies" id="num_copies">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group mt-3" id="college-form">
                <div class="d-flex flex-column justify-content-start custom-form-group">
                    <p class="font-small font-mont m-0 font-bold">Before MSU-MSAT, did you study in a different school?</p>
                    <div>
                        <label>
                            <input type="radio" name="isATransfer" value="Yes">
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="isATransfer" value="No">
                            No
                        </label>
                    </div>
                    <div class="w-100" id="ATransferSchool">
                        <label for="inputATransferSchool">Please indicate school</label>
                        <input type="text" class="form-control" id="inputATransferSchool" placeholder="">
                    </div>
                </div>
        
                <div class="d-flex flex-column justify-content-start custom-form-group mt-2">
                    <p class="font-small font-mont m-0 font-bold">After MSU-MSAT, did you study in a different school?</p>
                    <div>
                        <label>
                            <input type="radio" name="isBTransfer" value="Yes">
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="isBTransfer" value="No">
                            No
                        </label>
                    </div>
                    <div class="w-100" id="BTransferSchool">
                        <label for="inputAcadYear">Please indicate school</label>
                        <input type="text" class="form-control" id="inputBTransferSchool" placeholder="">
                    </div>
                </div>
            </div>
            <div id="requirements_section" class="">
                <div><hr class="row my-3 mt-3"></div>
                <div class="d-flex flex-column w-100 mb-3">
                    <p class="fs-4 font-mont font-bold">Upload Requirements</p>
                    <label for="inputRequirements" class="form-label">Requirements</label>
                    <input type="file" class="form-control" id="inputRequirements" name="requirements[]" multiple accept=".doc,.docx,.pdf,.jpg,.png,.jpeg,.svg">
                    <div id="selectedFiles" class="p-3" style="-webkit-text-stroke-width: medium;"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="dismissButton" class="btn btn-appoint dismissButton" data-bs-dismiss="modal">Close</button>
            <button type="button" id="proceedButton" class="btn btn-appoint">Proceed</button>
        </div>
        </div>
    </div>
</div>

<script>
    $('#inputRequirements').on('change', function() {
        var files = $(this)[0].files;
        var selectedFiles = '';
        for (var i = 0; i < files.length; i++) {
            selectedFiles += files[i].name + '<br>';
        }
        $('#selectedFiles').html(selectedFiles);
    });
</script>