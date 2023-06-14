<div
    class="modal fade"
    id="view-request-modal"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-hidden="true">
    <div
        class="modal-dialog modal-fullscreen modal-dialog-scrollable modal-dialog-centered"
    >
        <div class="modal-content">
            <div class="modal-body view-request-modal">
                <div class="d-flex flex-row align-items-center">
                    <div class="profile-pic">
                        <img src="/images/user.png" alt="" />
                    </div>
                    <div
                        class="d-flex flex-column w-100 font-13 px-3 font-nun"
                    >
                        <p class="p-0 m-0 fs-5 font-bold" id="viewFullName"></p>
                        <p class="p-0 m-0 font-small" id="viewEmail"></p>
                        <p class="p-0 m-0 font-small" id="viewCpNo"></p>
                    </div>
                </div>
                <!-- review -->
                
                <div
                    class="p-info d-flex flex-column m-0 px-5 py-4 mt-4"
                >
                    <div
                        class="p-info-head d-flex flex-row align-items-end"
                    >
                        <div class="logo">
                            <img
                                src="/images/person.png"
                                alt="user info"
                            />
                        </div>
                        <p
                            class="p-0 m-0 ms-2 font-nun fs-6 font-bold font-13"
                        >
                            Personal Information
                        </p>
                    </div>
                    <div class="row w-100 p-0 m-0 mt-3 font-nun">
                        <div class="col-md-6">
                            <div
                                class="row w-100 p-0 my-2 d-flex flex-row align-items-center"
                            >
                                <div class="col-md-6">
                                    <p class="info-title">STUDENT ID</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewSchoolID"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        STUDENT STATUS
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewStudentStatus"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">COURSE</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewCourse"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2" id="viewAcadYearSect" style="display: none;">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        ACADEMIC YEAR
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewAcadYear"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2" id="viewGradYearSect" style="display: none;">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        GRADUATED YEAR
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewGradYear"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md 6">
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">GENDER</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewGender"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        CIVIL STATUS
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewCivilStats"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">BIRTHDATE</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewBirthdate"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">ADDRESS</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewAddress"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-info d-flex flex-column m-0 px-5 py-4 mt-5" >
                    <div class="p-info-head d-flex flex-row align-items-end" >
                        <div class="logo">
                            <img
                                src="/images/appointment.png"
                                alt="user info"
                            />
                        </div>
                        <p class="p-0 m-0 ms-2 font-nun fs-6 font-bold font-13" >
                            Request Information
                        </p>
                    </div>
                    <div class="row w-100 p-0 m-0 mt-3 font-nun">
                        <div class="col-md-6">
                            <div class="row w-100 p-0 my-2 d-flex flex-row align-items-center" >
                                <div class="col-md-6">
                                    <p class="info-title">
                                        REQUEST ID
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewAppID"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        DATE REQUESTED
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewDocDateReq"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        DOCUMENT REQUESTED
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewDocName"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        COPIES REQUESTED
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewCopyReq"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2" id="viewTOR">
                                <div class="col-md-6">
                                    <p class="info-title">
                                        ACADEMIC YEAR
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewDocReqYear"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md 6">
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">PURPOSE</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewPurpose"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">Before MSU-MSAT, did you study in a different school?</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewATransfer"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">After MSU-MSAT, did you study in a different school?</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewBTransfer"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="requirements_info_section">
                    <div class="p-info d-flex flex-column m-0 px-5 py-4 mt-5">
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
                <div id="payment_sect_modal">
                <div class="p-info-pay d-flex flex-column m-0 px-5 py-4 mt-5">
                    <div
                        class="p-info-head d-flex flex-row align-items-end"
                    >
                        <div class="logo">
                            <img
                                src="/images/payment.png"
                                alt="user info"
                            />
                        </div>
                        <p
                            class="p-0 m-0 ms-2 font-nun fs-6 font-bold font-13"
                        >
                            Payment Method
                        </p>
                    </div>
                    <div class="row w-100 p-0 m-0 mt-3 font-nun">
                        <div class="col-md-8">
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">METHOD</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewMethod"></p>
                                </div>
                            </div>
                            <div class="row w-100 p-0 my-2">
                                <div class="col-md-6">
                                    <p class="info-title">REFERENCE NUMBER</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-content" id="viewReferenceNumber"></p>
                                </div>
                            </div>
                            <!-- <div class="row w-100 p-0 my-2" id="viewPopImage" style="display: none;">
                                <div class="payment-method">
                                    <img
                                        src=""
                                        alt=""
                                        id="viewProofOfPayment"
                                    />
                                </div>
                            </div> -->
                            <div class="w-100 p-0 my-2" id="viewPopButton" style="display: none;">
                                <p class="info-title">PROOF OF PAYMENT</p>
                                <div class="d-flex flex-row flex-wrap">
                                    <a href="" class="btn btn-slot m-2" style="flex:1;" target="_blank" id="viewProofOfPaymentPic">View image</a>
                                    <a href="" class="btn btn-slot m-2" style="flex:1;" download id="downloadProofOfPayment">Download image</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row w-100 p-0 my-2" id="viewORImage">
                                <p class="info-title mb-2">OFFICIAL RECEIPT (OR)</p>
                                <div class="payment-method">
                                    <img
                                        src=""
                                        alt=""
                                        id="viewOfficialReceipt"
                                    />
                                </div>
                                <div class="d-flex flex-row flex-wrap">
                                    <a href="" class="btn btn-slot m-2" style="flex:1;" target="_blank" id="viewOfficialReceiptPic">View</a>
                                    <a href="" class="btn btn-slot m-2" style="flex:1;" download id="downloadOfficialReceipt">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div
                    class="d-flex flex-row justify-content-end m-0 mt-5"
                >
                    <button
                        class="btn btn-dark"
                        type="button"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>