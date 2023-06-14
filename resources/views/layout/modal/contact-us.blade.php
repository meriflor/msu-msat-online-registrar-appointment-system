<!-- MODAL SECTION -->
    <!-- contact us modal -->
    <!-- <div class="modal fade" id="contact-us-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5 font-este" id="staticBackdropLabel">Contact Us</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body font-este p-4">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="inputMessageFullName" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="inputMessageEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-lg-12">
                                <textarea class="form-control" style="height: 100px;" placeholder="Message" id="inputMessage"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-agree font-este" data-bs-dismiss="modal">Send</button>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="contact-us-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content modal-dialog-confirm modal-confirm-padding">
                <div class="modal-body text-center m-0 p-4">
                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <h1 class="modal-title fs-3 font-white font-nun" id="staticBackdropLabel">Contact Us</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="d-flex flex-column align-items-start pt-3">
                            <label for="inputName" class="font-white">Full Name</label>
                            <input class="form-control" name="fullname" id="inputName" type="text" value="" aria-label="default input example" placeholder="Fullname">
                            <label for="inputEmail" class="pt-2 font-white">Email</label>
                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
                            <label for="inputMessage" class="pt-2 font-white">Message</label>
                            <textarea type="text" class="form-control font-nun" name="message" id="inputMessage" placeholder="Message"></textarea>
                        </div>
                        <div class="d-flex flex-row justify-content-end pt-3">
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-submit ms-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>