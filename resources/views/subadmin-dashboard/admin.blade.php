<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin-Registrar | MSU-MSAT Registrar's Online Appointment System</title>

        <!-- bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
            crossorigin="anonymous"
        />
        <link rel="icon" type="image/png" href="images/msat-logo.png">
        <link rel="stylesheet" href="{{ asset('css/admin/navbar.css') }}"  />
        <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}"  />
        <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/display.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/message.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/forms.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/announcement.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/modal.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/defaultcss/pagination.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/defaultcss/calendar.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/defaultcss/scrollbar.css') }}">
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    </head>
    <body>

        <!-- //TODO: NAVBAR -->
        <nav
            class="navbar navbar-expand navbar-dark d-flex flex-column align-item-start"
            id="sidebar"
        >
            <div class="navbar-brand d-flex flex-row m-0 align-items-center">
                <div class="logo">
                    <img
                        class="image-fluid"
                        src="{{ asset('images/msat-logo.png') }}"
                        alt=""
                    />
                </div>
                <p class="text-wrap fs-6 font-corm font-white ps-3 m-0">
                    University Registrar Handler
                </p>
            </div>
            <ul class="navbar-nav d-flex flex-column mt-3 w-100">
                <li class="nav-item w-100">
                    <a
                        href="/dashboard-admin-appointments/dashboard"
                        class="nav-link"
                        >Dashboard
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="/dashboard-admin-appointments/pending-requests" class="nav-link"
                        >Pending Requests
                        @if(!empty($filteredRequests) && count($filteredRequests) > 0)
                        <span class="badge bg-danger"> {{ count($filteredRequests )}}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="/dashboard-admin-appointments/processed-requests" class="nav-link"
                        >Processed Documents
                    @if(count($processedDocs) > 0)
                    <span class="badge bg-danger"> {{ count($processedDocs )}}</span>
                    @endif
                    </a>
                </li>
                <!-- <li class="nav-item w-100">
                    <a href="/dashboard-admin-appointments/request-all" class="nav-link"
                        >Appointment Requests</a
                    >
                </li>
                <li class="nav-item w-100">
                    <a href="/dashboard-admin-appointments/request-reschedule" class="nav-link"
                        >Appointment Remarks
                    </a>
                </li> -->
                <li class="nav-item w-100">
                    <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>

        <div class="content-container px-5 py-3">
            <div class="content-main">
                @yield('content')
            </div>
        </div>


        <!-- FIX footer -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"
        ></script>
        <script src="{{ asset('js/admin/divheight.js') }}"></script>
        <script src="{{ asset('js/admin/appointment/status-button.js') }}"></script>
        <script src="{{ asset('js/admin/appointment/info-display.js') }}"></script>
        <script src="{{ asset('js/admin/admin.js') }}"></script>

        
        <script src="{{ asset('js/admin/form-config.js') }}"></script>
        <script src="{{ asset('js/admin/announcement-config.js') }}"></script>
        <script src="{{ asset('js/admin/faq-config.js') }}"></script>

        <script src="{{ asset('js/subadmin-cashier/approve-incomplete.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

        <script>  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    right:'title'
                },
                editable: false,
                businessHours: {
                    dow: [1,2,3,4,5], 
                    start: '08:00',
                    end: '17:00',
                },
                selectConstraint: {
                    dow: [1, 2, 3, 4, 5] 
                },
                events:'/appointment_slots',
                selectable:true,
                selectHelper: true,
                select: function(date, jsEvent, view, event){
                    //review =============================Code for not disabled day=========================================
                    var events = $('#calendar').fullCalendar('clientEvents');
                    var event = events.find(e => moment(e.start).isSame(date, 'day'));
                    var jsDate = date.toDate();
                    var currentDate = new Date();
                    var date = moment(date).format("YYYY-MM-DD");
                    if(event){
                        var url = '/dashboard-admin-appointments/request/'+ date;
                        console.log(url);
                        window.location.href = url;
                    } 
                    console.log(events.start);
                },
                eventRender: function(event, element) {
                    if (event.slots === 0) { //if disabled,, appointment slots == 0 as default sa db
                        console.log(event.slots);
                        element.css('display', 'none');
                        var cell = $(`.fc-bg td[data-date="${event.start.format('YYYY-MM-DD')}"]`);
                        cell.addClass('fc-disabled-01');
                    }if(event.currentSlot !== event.slots){
                        element.addClass('fc-event-available');
                    }else{
                        element.addClass('fc-event-full');
                    }
                    console.log(event.start);
                },
                dayRender: function(date, cell, event) {
                    var currentDate = new Date();
                    if (date < currentDate) {
                        $(cell).addClass('fc-disabled');
                    }
                    if ($(cell).hasClass('fc-disabled')) {
                        return;
                    }
                }
            });
        </script>


        <script>
            //sorting datable
            $('#appointmentRecords').DataTable();
            $('#appointmentRequests').DataTable();
            $('#claimedDocuments').DataTable();
            $('#readyToClaimDocuments').DataTable();
            $('#onProcessDocuments').DataTable();
            $('#pendingRequests').DataTable();
            $('#onlinePaymentPending').DataTable();
            $('#walkinPaymentPending').DataTable();
            $('#noFeesTable').DataTable();
            $('#requestTable').DataTable();
            $('#pendingPaymentTable').DataTable();

            //export appointment records to excel
            $('#export-app-records').on('click', function() {
                // Get HTML table data
                var table = document.getElementById("appointmentRecords");
                // Remove the last column from the table
                var rows = table.rows;
                for (var i = 0; i < rows.length; i++) {
                    rows[i].deleteCell(-1);
                }
                // Convert table data to workbook
                var wb = XLSX.utils.table_to_book(table);
                // Save data to Excel file
                XLSX.writeFile(wb, "appointment-records.xlsx");
            });
            $(document).ready(function() {
                var backToTopBtn = $("#back-to-top-btn");

                $(window).scroll(function() {
                    if ($(window).scrollTop() > 100) {
                        backToTopBtn.addClass("show").removeClass("hide");
                    } else {
                        backToTopBtn.addClass("hide").removeClass("show");
                    }
                });

                backToTopBtn.click(function() {
                    $("html, body").animate({ scrollTop: 0 }, "smooth");
                });

                var menuBtn = $("#menu-btn");
                var sidebar = $("#sidebar");
                var container = $(".content-container");

                menuBtn.click(function() {
                    sidebar.toggleClass("active-nav");
                    container.toggleClass("active-cont");
                });
            });

            var url = "{{ url('') }}";
        </script>
        
        
        <!-- todo modals -->
        @include('admin-dashboard.modal.info')
        @include('admin-dashboard.modal.set-slot')
        @include('admin-dashboard.modal.confirm-status')
        @include('admin-dashboard.modal.forms.add-form')
        @include('admin-dashboard.modal.forms.delete-form')
        @include('admin-dashboard.modal.forms.edit-form')
        @include('admin-dashboard.modal.announcement.add-announcement')
        @include('admin-dashboard.modal.announcement.delete-announcement')
        @include('admin-dashboard.modal.announcement.edit-announcement')  
        @include('admin-dashboard.modal.forms.add-course')
        @include('admin-dashboard.modal.forms.delete-course')
        @include('admin-dashboard.modal.forms.edit-course')
        @include('admin-dashboard.modal.faqs.add-faqs')
        @include('admin-dashboard.modal.faqs.delete-faqs')
        @include('admin-dashboard.modal.faqs.edit-faqs')
        @include('admin-dashboard.modal.remarks')
        @include('admin-dashboard.modal.info-request')
        @include('subadmin-cashier-dashboard.modal.incomplete-remarks')

    </body>
</html>
