<div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Review</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5">
            <!-- review hidden inputs -->
            <input type="hidden" id="proof_of_payment_01">
            <input type="hidden" id="num_copies_02">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="">First Name</label>
                    <input class="form-control" type="text" value="{{ $firstName }}" aria-label="default input example" disabled>
                </div>    
                <div class="col-md-3">
                    <label for="">Last Name</label>
                    <input class="form-control" type="text" value="{{ $lastName }}" aria-label="default input example" disabled>
                </div>  
                <div class="col-md-3">
                    <label for="">Middle Name</label>
                    <input class="form-control" type="text" value="{{ $middleName }}" aria-label="default input example" disabled>
                </div>  
                <div class="col-md-3">
                    <label for="">Suffix</label>
                    <input class="form-control" type="text" value="{{ $suffix }}" aria-label="default input example" disabled>
                </div>  
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="">Student ID</label>
                    <input class="form-control" type="text" value="{{ $school_id }}" aria-label="default input example" disabled>
                </div> 
                <div class="col-md-3">
                    <label for="">Cellphone No.</label>
                    <input class="form-control" type="text" value="{{ $cell_no }}" aria-label="default input example" disabled>
                </div>    
                <div class="col-md-3">
                    <label for="">Email</label>
                    <input class="form-control" type="email" value="{{ $email }}" aria-label="default input example" disabled>
                </div>  
                <div class="col-md-3">
                    <label for="">Address</label>
                    <input class="form-control" type="text" value="{{ $address }}" aria-label="default input example" disabled>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="">Civil Status</label>
                    <input class="form-control" type="text" value="{{ $civil_status }}" aria-label="default input example" disabled>
                </div>    
                <div class="col-md-4">
                    <label for="">Birthdate</label>
                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($birthdate)->format('F d, Y') }}" aria-label="default input example" disabled>
                </div>    
                <div class="col-md-4">
                    <label for="">Gender</label>
                    <input class="form-control" type="text" value="{{ $gender }}" aria-label="default input example" disabled>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label for="">Status</label>
                    <input class="form-control" id="inputStudentStatus" type="text" value="{{ $status }}" aria-label="default input example" disabled>
                </div>
                <div class="col-lg-4">
                    <label for="">Course</label>
                    <input class="form-control" type="text" value="{{ $course }}" aria-label="default input example" disabled>
                </div>
                <div class="col-lg-4 " id="input-acadYear">
                    <label for="inputAcadYear">Academic Year</label>
                    <input type="text" class="form-control" id="inputAcadYear" value="{{ $acadYear }}" disabled>
                </div>
                <div class="col-lg-4 " id="input-gradYear">
                    <label for="inputGradYear">Year Graduated</label>
                    <input type="text" class="form-control" id="inputGradYear" value="{{ $gradYear }}" disabled>
                </div>
            </div>

            <div class="py-3"><hr></div>
            <!-- review -->
            <div class="form-group row" id="college-form">
                <div class="col-md-6 d-flex flex-column justify-content-start custom-form-group">
                    <label for="inputATransferInfo">Before MSU-MSAT, did you study in a different school?</p>
                    <input type="text" class="form-control" id="inputATransferInfo" value="" disabled>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-start custom-form-group">
                    <label for="inputBTransferInfo">After MSU-MSAT, did you study in a different school?</p>
                    <input type="text" class="form-control" id="inputBTransferInfo" value="" disabled>
                </div>
            </div>
            <div class="form-group row mt-2">
                <div class="col-md-6">
                    <label for="">Purpose</label>
                    <textarea id="app_purpose01" class="form-control" type="text" aria-label="default input example" disabled></textarea>
                </div>  
                <!-- <div class="col-md-6">
                    <label for="">Appointment Date</label>
                    <input class="form-control" type="text" placeholder="" id="appointment_date" aria-label="default input example" value="" disabled>
                </div> -->
                <div class="col-md-6 d-flex flex-row flex-wrap">
                    <span><b>Number of Copy: </b> <span id="num_copies_01"></span></span> 
                </div>
            </div>
            <!-- <div class="form-group row mt-2">
                <div id="payment_method_val" class="col-md-4">
                    <div class="d-flex flex-row flex-wrap">
                        <span><b>Payment Method: </b> <span id="payment_method_01"></span></span> 
                    </div>
                </div>
                <div id="reference_number_val" class="col-md-4">
                    <div class="d-flex flex-row flex-wrap">
                        <span><b>Reference Number: </b> <span id="reference_number_01"></span></span> 
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-row flex-wrap">
                    <span><b>Number of Copy: </b> <span id="num_copies_01"></span></span> 
                </div>
            </div> -->
        </div>
        <div class="modal-footer">
            <small class="font-maroon d-flex flex-row justify-content-start" style="flex: 1;"><span>*You can change your personal information located at the<span> <a href="{{ route('edit-profile') }}" class="font-maroon font-bold">Edit Profile</a> </span>section.</span></small>
            <button type="button" class="btn btn-appoint" data-bs-toggle="modal" data-bs-target="#appointmentModal">Back</button>
            <button type="submit" id="submitButton" class="btn btn-appoint">Submit</button>
            <!-- data-bs-toggle="modal" data-bs-target="#confirmedModal" -->
        </div> 
        </div>
    </div>
</div>