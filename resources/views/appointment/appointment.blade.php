<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Online Appointment</title>
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    
    <link rel="icon" type="image/png" href="images/msat-logo.png">
    <link rel="stylesheet" href="css/dashboard/dasboard02.css">
    <link rel="stylesheet" href="css/dashboard/fonts.css">
    <link rel="stylesheet" href="css/dashboard/breakpoints.css">
    <link rel="stylesheet" href="css/dashboard/modal.css">
    <link rel="stylesheet" href="css/dashboard/reciept.css">
    <link rel="stylesheet" href="css/defaultcss/scrollbar.css">
    <link rel="stylesheet" href="{{ asset('css/defaultcss/calendar.css') }}" />
    <link rel="stylesheet" href="css/dashboard/notification.css" />
    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @media print {
            .receipt-box::before {
                content: "";
                background-image: url(/images/msat-logo.png);
                background-position: top right;
                position: absolute;
                background-size: contain;
                background-repeat: no-repeat;
                opacity: 0.35;
                height: 40%;
                width: 40%;
                z-index: 1;
                top: 50px;
                right: 50px;
            }
        }
    </style>
</head>
<body> 

    <!-- NAVBAR pan ni //TODO -->
    <div class="navbar-cover">
        <nav class="navbar navbar-expand-md navbar-dark p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <div class="d-flex flex-row justify-content-between align-items-center w-100 container py-4">
                    <div class="navbar-brand d-flex flex-row align-items-center">
                        <img src="/images/msat-logo.png" alt="">
                        <span class="font-mont font-bold mx-3 lh-10">MSU-MSAT Registrar's Online <br>Appointment</span>
                    </div>
                    <div class="button">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="menu w-100 py-2">
                    <div class="container d-flex flex-row justify-content-start">
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                              <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav font-mont">
                                    <li class="nav-item">
                                        <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="/faqs" class="nav-link">FAQs</a>
                                    </li>  --}}
                                    <!-- fix add url for the requests which is differ from the appointments -->
                                    <li class="nav-item">
                                        <a href="/request-records" class="nav-link {{ Request::is('request-records') ? 'active' : '' }}">Request Records</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/appointment-records" class="nav-link {{ Request::is('appointment-records') ? 'active' : '' }}">Appointments</a>
                                    </li>
                                    <li class="nav-item">
                                        <!-- fix -->
                                        <a href="/notification" class="nav-link {{ Request::is('notification') ? 'active' : '' }}">Notification
                                            <span id="notif-space">
                                                <span class="badge bg-danger" id="unread-notif"></span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle {{ Request::is('edit-profile', 'settings') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $firstName }}   {{ $lastName }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/edit-profile">Edit Profile</a></li>
                                            <li><a class="dropdown-item" href="/settings">Account Settings</a></li>
                                            <li><a class="dropdown-item" href="logout">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- content sa user page,, mgchange2 gamit atung extend2 section2 chu2, idivide nlng daun palihog-->
    <div class="site-content d-flex justify-content-center py-5 container">
        <!-- dashboard -->
        <div class="dashboard d-flex row flex-row w-100 font-mont" id="dashboard">
            <div class="col-md-4 mb-4 font-mont">
                <div class="content-box p-4">
                    <h5 class="font-bold font-maroon">Announcements</h5>
                    <ul class="list-group list-group-flush">
                        @if(count($announcements) > 0)
                            @foreach($announcements as $announcement)
                            <a href="/announcement" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $announcement->announcement_title }}</h6>
                                    <small class="text-body-secondary">{{ $announcement->created_at->format('m/d/y') }}</small>
                                </div>
                            </a>
                        @endforeach
                        @else
                            <li class="list-group-item">There are no announcements at the moment.</li>
                        @endif
                    </ul>
                    <hr>
                    <h5 class="font-bold font-maroon">Requests</h5>
                    <ul class="list-group list-group-flush">
                        @if(count($pending) > 0)
                            @foreach($pending as $pendapp)
                            @php
                                $has_resched = false;
                                foreach($bookings as $booking) {
                                    if($booking->appointment_id == $pendapp->id && $booking->resched == 1) {
                                        $has_resched = true;
                                        break;
                                    }
                                }
                            @endphp
                            <a class="list-group-item"> 
                                <b>{{ $pendapp->form->name }} </b>
                                
                                @if($has_resched)
                                    <span style="color: #f3f3f3; background-color: maroon;"><i><b>Reschedule</b></i></span>
                                @else
                                    @if($pendapp->status === 'Confirmed Payment' || $pendapp->status === 'Pending')
                                        <span style="color: #4a7453;"><i><b>Pending</b></i></span>
                                    @elseif($pendapp->status === 'On Process')
                                        <span style="color: #3c8fad;"><i><b>On Process</b></i></span>
                                    @elseif($pendapp->status === 'Ready to Claim')
                                        <span style="color: #c18930;"><i><b>Ready to Claim</b></i></span>
                                    @endif
                                @endif
                            </a>
                            @endforeach
                        @else
                            <li class="list-group-item">You have not requested any documents yet.</li>
                        @endif
                    </ul>
                    @if(count($pending_appointments) > 0)
                    <hr>
                    <h5 class="font-bold font-maroon">Appointment(s)</h5>
                    <ul class="list-group list-group-flush">  
                    @foreach($pending_appointments as $appointments)
                    <a href="/appointment-records" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $appointments->form->name }}</h6>
                            <small class="text-body-secondary">{{ $appointments->created_at->format('m/d/y') }}</small>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-8 ps-3">
                <div class="dashboard-content">
                    @yield('content')
                    <!-- dashboard-document lists appointment -->
                    <!-- edit profile section link -->
                    <!-- account settings section  -->
                    <!-- APPOINTMENT RECORD SECTION -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="js/dashboard/navbar.js"></script>
    <!-- <script src="js/navbar.js"></script> -->
    <script src="js/form.js"></script>
    @include('appointment.modal.cancel-app')
    @include('appointment.modal.book-appointment')
    @include('appointment.modal.review')
    @include('appointment.modal.confirmation')
    @include('appointment.modal.upload-payment')
    @include('appointment.modal.set-appointment')

    <!-- script for the calendar and such exclusively for appointment blade php -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() { 
            var cell;
            $('.download-button').on('click', function() {
                var app_id = $(this).data('app-id');
                window.jsPDF = window.jspdf.jsPDF;
                html2canvas(document.querySelector('#my-div-' + app_id)).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    var pdf = new jsPDF();
                    var imgProps = pdf.getImageProperties(imgData);
                    var pdfWidth = pdf.internal.pageSize.getWidth() - 30;
                    var pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                    var margin = (pdf.internal.pageSize.getWidth() - pdfWidth) / 2; 

                    pdf.addImage(imgData, 'PNG', margin, 15, pdfWidth, pdfHeight);
                    pdf.save('msu-msat-doc-request.pdf');
                });
            });

            $('.print-button').on('click', function() {
                var app_id = $(this).data('app-id');
                var printContent = document.querySelector('#my-div-' + app_id);

                // Create a new window for printing
                var printWindow = window.open('', '_blank');

                // Append the print content to the new window's document
                printWindow.document.write('<html><head><title>Print</title>');
                // printWindow.document.write('<style>@media print{.receipt-box::before { display: block; }}</style>');
                printWindow.document.write('<link rel="stylesheet" href="css/dashboard/fonts.css">');
                printWindow.document.write('<link rel="icon" type="image/png" href="images/msat-logo.png">');
                printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">');
                printWindow.document.write('<link rel="stylesheet" href="css/dashboard/reciept.css">');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<div style="max-width: 700px; margin: 0 auto;">');
                printWindow.document.write(printContent.outerHTML);
                printWindow.document.write('</div></body></html>');

                setTimeout(function() {
                    printWindow.print();
                    printWindow.close();
                }, 2000);
            });
            
        });
        
        var a_transfer;
        var b_transfer;
        var a_transfer_school;
        var b_transfer_school;
        $('.open-modal').on('click', function() {
            var form_id = $(this).data('form-id');
            var form_name = $(this).data('form-name');
            var form_fee = $(this).data('form-fee');
            var form_pages = $(this).data('form-pages');
            var form_max_time = $(this).data('form-max-time');
            var form_acad_year = $(this).data('form-acad_year');
            var form_requirements = $(this).data('form-requirements');
            var accordion_item = $(this).closest('.accordion-item');
            var accordion_id = accordion_item.find('.accordion-collapse').attr('id');
            var modal = $('#appointmentModal');

            console.log("acad year:"+ form_acad_year);
            console.log("form_requirements:"+ form_requirements);
            if(form_acad_year == 1){
                $('#app-acad-year').show();
            }else{
                $('#app-acad-year').hide();
            }if(form_requirements == 1){
                $('#requirements_section').show();
            }else{
                $('#requirements_section').hide();
            }
            
            if(form_pages > 1){
                var total = form_fee * form_pages;
                modal.find('#doc_fee').text("PHP "+total+".00");
            }else{
                modal.find('#doc_fee').text("PHP "+form_fee+".00");
            }
            

            if(form_fee == 0){
                modal.find('#payment_section').hide();
            }else{
                modal.find('#payment_section').show();
                $('#num_copies').on('change', function() {
                    var copies = $(this).val();
                    if(copies > 1){
                        var total = form_fee * form_pages * copies;
                        modal.find('#doc_fee').text("PHP "+total+".00");
                    }else{
                        var total = form_fee * form_pages;
                        modal.find('#doc_fee').text("PHP "+total+".00");
                    }
                });
            }
            modal.find('#exp_date').text(form_max_time);
            modal.find('#form-name').text(form_name);
            modal.find('#form_name').text(form_name);
            modal.find('#form_acad_year').val(form_acad_year);
            modal.find('#form_requirements').val(form_requirements);
            modal.find('#form_fee_val').val(form_fee);
            modal.find('#form_id').val(form_id);
            modal.find('#accordion_id').val(accordion_id);
            console.log(form_id);
            console.log(form_name);
            console.log(accordion_id);
            $('#appointmentModal').modal('show');
        });

        $('.dismissButton').click(function() {
            // Clear all inputs with the 'inputToClear' class
            $('#app_purpose').val('');
            $('#acad_year').val('');
            $('input[name="isATransfer"]').prop('checked', false);
            $('input[name="isBTransfer"]').prop('checked', false);
            $('#inputATransferSchool').val('');
            $('#inputBTransferSchool').val('');
            $('input[name="payment_method"]').prop('checked', false);
            $('#reference_number').val('');
            $('input[type="file"]').val(null);
            appointment_date = null;
            $('#app_date').text('Select a date first.');
            $('.fc-selected-date').removeClass('fc-selected-date');
            $('#gcash-sect').hide();
        });
// review
        $('#proceedButton').on('click', function(event) {
            var form_id = $('#form_id').val();
            var app_purpose = $('#app_purpose').val();
            var acad_year = $('#acad_year').val();
            var num_copies = parseInt(document.querySelector('select[name="num_copies"]').value);
            var form_fee = $('#form_fee_val').val();
            var form_acad_year = $('#form_acad_year').val();
            var form_requirements = $('#form_requirements').val();

            a_transfer = $('input[name=isATransfer]:checked').val();
            b_transfer = $('input[name=isBTransfer]:checked').val();
            a_transfer_school = $('#inputATransferSchool').val();
            b_transfer_school = $('#inputBTransferSchool').val();

            // fix requriements
            var files = $('#inputRequirements')[0].files;
            //fix end of requriements

            if(app_purpose === "" || a_transfer === undefined || b_transfer === undefined){
                alert('Please fill up the provided inputs.');
                return false;
            }
            console.log('form_requirements = '+form_requirements);
            console.log('files = '+files);
            if (form_acad_year == 1 && (acad_year === "" || acad_year === null)) {
                    alert('Please fill up the provided inputs.');
                return false;
            }if (form_requirements == 1 && files.length === 0) {
                    alert('Please upload your requirements.');
                return false;
            }

            $('#appointmentModal').modal('hide');
            $('#reviewModal').modal('show');
            $('#form_id').val(form_id);
            $('#acad_year').val(acad_year);
            $('#app_purpose01').val(app_purpose);
            if(num_copies == 1){
                $('#num_copies_01').text(num_copies + " copy");
                $('#num_copies_02').val(num_copies);
            }else{
                $('#num_copies_01').text(num_copies + " copies");
                $('#num_copies_02').val(num_copies);
            }
                
            //todo
            if(a_transfer == "Yes"){
                $('#inputATransferInfo').val(a_transfer + ", " + a_transfer_school);
            }else{
                $('#inputATransferInfo').val(a_transfer);
            }if(b_transfer == "Yes"){
                $('#inputBTransferInfo').val(b_transfer + ", " + b_transfer_school);
            }else{
                $('#inputBTransferInfo').val(b_transfer);
            }


            console.log(form_id);
            console.log(app_purpose);
            console.log(acad_year);
            console.log(num_copies);
            console.log(files);
        });

        $('#submitButton').on('click', function(event) {
            var form_id = $('#form_id').val();
            var app_purpose = $('#app_purpose').val();
            var acad_year = $('#acad_year').val();
            var num_copies = $('#num_copies_02').val();
            console.log(num_copies);
            if(a_transfer === "yes"){
                a_transfer = 1;
                a_transfer_school = $('#inputATransferSchool').val();
            }else{
                a_transfer = 0;
                a_transfer_school = null;
            }if(b_transfer === "yes"){
                b_transfer = 1;
                b_transfer_school = $('#inputBTransferSchool').val();
            }else{
                b_transfer = 0;
                b_transfer_school = null;
            }

            var files = $('#inputRequirements')[0].files;

            $('#reviewModal').modal('hide');
            $('#confirmedModal').modal('show');
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('form_id', form_id);
            formData.append('app_purpose', app_purpose);
            formData.append('acad_year', acad_year);
            formData.append('a_transfer', a_transfer);
            formData.append('a_transfer_school', a_transfer_school);
            formData.append('b_transfer', b_transfer);
            formData.append('b_transfer_school', b_transfer_school);
            formData.append('num_copies', num_copies);
            for (var i = 0; i < files.length; i++) {
                formData.append('requirements[]', files[i]);
                console.log(files[i]);
            }

            $.ajax({
                url: "{{ route('bookAppointment') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
            
        });

        $.ajax({
            url: "{{ route('unread-notif') }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response.count)
                if(response.count <=0){
                   $('#notif-space').hide();
                }else{
                   $('#notif-space').show();
                    $('#unread-notif').text(response.count);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
            
    </script>
    @include('appointment.modal.reschedule')
    @include('appointment.modal.reupload-req')
</body>
</html>
