<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | MSU-MSAT Registrar's Online Appointment System</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
    <link rel="icon" type="image/png" href="images/msat-logo.png">
    <link rel="stylesheet" href="{{ asset('css/admin/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/display.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/message.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/forms.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/announcement.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/settings.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/defaultcss/pagination.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/defaultcss/calendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/defaultcss/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/notification.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
</head>

<body>

    <!-- //TODO: NAVBAR -->
    <nav class="navbar navbar-expand navbar-dark d-flex flex-column align-item-start" id="sidebar">
        <div class="navbar-brand d-flex flex-row m-0 align-items-center">
            <div class="logo">
                <img class="image-fluid" src="{{ asset('images/msat-logo.png') }}" alt="" />
            </div>
            <p class="text-wrap fs-6 font-corm font-white ps-3 m-0">
                University Registrar
            </p>
        </div>
        <ul class="navbar-nav d-flex flex-column mt-3 w-100">
            <li class="nav-item w-100">
                <a href="/dashboard-admin/dashboard" class="nav-link">Dashboard
                </a>
            </li>
            <li class="nav-item w-100">
                <a href="/dashboard-admin/message" class="nav-link">Message</a>
            </li>
            <li class="nav-item w-100">
                <a href="/dashboard-admin/registration-approval" class="nav-link">
                    User Registration Approval
                    <span class="badge bg-danger" id="pending-registration-count"></span>
                </a>
            </li>
            <hr />
            <li class="nav-item w-100">
                <a href="/dashboard-admin/config" class="nav-link">Forms Configuration</a>
            </li>
            <li class="nav-item w-100">
                <a href="/dashboard-admin/announcement" class="nav-link">Announcement</a>
            </li>
            <li class="nav-item w-100">
                <a href="/dashboard-admin/faqs" class="nav-link">FAQs</a>
            </li>
            <li class="nav-item w-100">
                <a href="/dashboard-admin/settings" class="nav-link">Settings</a>
            </li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/admin/divheight.js') }}"></script>
    <script src="{{ asset('js/admin/appointment/status-button.js') }}"></script>
    <script src="{{ asset('js/admin/appointment/info-display.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>


    <script src="{{ asset('js/admin/form-config.js') }}"></script>
    <script src="{{ asset('js/admin/announcement-config.js') }}"></script>
    <script src="{{ asset('js/admin/faq-config.js') }}"></script>

    <script src="{{ asset('js/subadmin-cashier/approve-incomplete.js') }}"></script>
    <script src="{{ asset('js/admin/functions/password-validation.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                right: 'title'
            },
            editable: false,
            businessHours: {
                dow: [1, 2, 3, 4, 5],
                start: '08:00',
                end: '17:00',
            },
            selectConstraint: {
                dow: [1, 2, 3, 4, 5]
            },
            events: '/appointment_slots',
            selectable: true,
            selectHelper: true,
            longPressDelay: 0,
            select: function(date, jsEvent, view, event) {
                //review =============================Code for not disabled day=========================================
                var events = $('#calendar').fullCalendar('clientEvents');
                var event = events.find(e => moment(e.start).isSame(date, 'day'));
                var jsDate = date.toDate();
                var currentDate = new Date();

                if (jsDate.getDay() === 0 || jsDate.getDay() === 6) { //if weekends return falsee
                    return false;
                } else if (date <=
                    currentDate
                    ) { //if past day na igo ra sila mkaview daretso sa mga appointment atu nga adlawa,, and unclickable ang mga wlay event na date
                    var date = moment(date).format("YYYY-MM-DD");
                    if (event) {
                        var url = '/dashboard-admin/request/' + date;
                        console.log(url);
                        window.location.href = url;
                    }
                    return false;
                } else { //sa modal ni na part ning hide2,, sa set-slot.blade.php PS. gahasul2 lmng dri,, wa gyd nngitag laing pamaagi,, -_-
                    $('#view_app_btn').hide();
                    $('#submit_slot').hide();
                    $('#delete_slot').hide();
                    $('#edit_slot').hide();

                    $('#set_slot_div').hide();
                    $('#delete_slot_div').hide();

                    $('#delete_div').hide();
                    $('#edit_div').hide();
                    $('#slot_info').hide();
                    var date = moment(date).format("YYYY-MM-DD");
                    var textDate = moment(date).format("MMMM DD, YYYY");
                    if (event) {
                        $('#appointment_slot_modal').modal('show');
                        $('#appointment_slot_modal #slot_date_text').text(textDate);

                        if (event.isDisabled) {
                            $('#delete_div').show();
                            $('#edit_div').show();
                        }
                        if (event.slots > 0) {
                            $('#view_app_btn').show();
                            $('#delete_div').show();
                            $('#edit_div').show();
                            if (event.currentSlot > 0) {
                                $('#slot_info').show();
                                $('#info-text').text("There are " + event.currentSlot +
                                    " appointments scheduled for this day.");
                                if (event.pending > 0) {
                                    $('#pending-text').text(event.pending + " : pending ");
                                }
                                if (event.onProcess > 0) {
                                    $('#onProcess-text').text(event.onProcess + " : on processed ");
                                }
                                if (event.readyToClaim > 0) {
                                    $('#readyToClaim-text').text(event.readyToClaim + " : ready to claim");
                                }
                                if (event.claimed > 0) {
                                    $('#claimed-text').text(event.claimed + " : claimed");
                                }
                            }

                        }
                    } else {
                        $('#appointment_slot_modal #slot_date_text').text(textDate);
                        $('#appointment_slot_modal').modal('show');
                        $('#set_slot_div').show();
                        $('#submit_slot').show();
                        $('#appointment_slot_modal #slot_date').val(date);
                        // console.log(event.isDisabled);
                        // $('#appointment_slot_modal #disabled_text').val(event.isDisabled);
                    }


                    //review ==============================URL to the App Requests passing the specifc date and edit, delete ajax,, also clearing inputs============================

                    $('#view_app_btn').on('click', function() {
                        var url = 'request/' + date;
                        console.log(url);
                        window.location.href = url;
                    });
                    $('#appointment_slot_modal #delete_slot').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ route('appointment_slots.destroy', '') }}/" + event.id,
                            success: function(response) {
                                window.location.reload();
                            },
                            error: function(xhr) {
                                // handle error response
                            }
                        });
                    });
                    $('#appointment_slot_modal #edit_slot').click(function(e) {
                        var slot = $('#available_slots').val();
                        var disable = $('#disable_check').is(':checked');
                        if (disable === true) {
                            disable = 1;
                            slot = 0;
                        } else {
                            if (slot === null || slot === "" || slot === undefined) {
                                console.log('this is null');
                                alert("Please enter a slot.");
                                return false;
                            } else if (slot == 0) {
                                disable = 1;
                            } else {
                                disable = 0;
                            }
                        }
                        console.log(event.id);
                        console.log(slot);
                        console.log(disable);
                        $.ajax({
                            url: '/appointment_slots/edit/' + event.id,
                            type: 'POST',
                            data: {
                                slot: slot,
                                disable: disable,
                                _method: 'PUT'
                            },
                            success: function(response) {
                                window.location.reload();
                            },
                            error: function(xhr) {
                                // handle error response
                            }
                        });
                    });
                    $('#dismiss_cal').click(function() {
                        $('#delete_check').prop('checked', false);
                        $('#edit_check').prop('checked', false);
                        $('#hr_insert').hide();
                        $('#available_slots').val("");
                        $('#pending-text').text("");
                        $('#onProcess-text').text("");
                        $('#readyToClaim-text').text("");
                        $('#claimed-text').text("");
                        $('#gcash-sect').hide();
                    });
                }
            },
            eventRender: function(event, element) {
                if (event.slots === 0) { //if disabled,, appointment slots == 0 as default sa db
                    console.log(event.slots);
                    element.css('display', 'none');
                    var cell = $(`.fc-bg td[data-date="${event.start.format('YYYY-MM-DD')}"]`);
                    cell.addClass('fc-disabled-01');
                }
                if (event.currentSlot !== event.slots) {
                    element.addClass('fc-event-available');
                } else {
                    element.addClass('fc-event-full');
                }
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
        $(document).ready(function() {
            // $('#appointmentRecords').DataTable();
            $('#appointmentRecords').DataTable();
            $('#appointmentRequests').DataTable();
            $('#claimedDocuments').DataTable();
            $('#readyToClaimDocuments').DataTable();
            $('#onProcessDocuments').DataTable();
            // fix
            $('#pendingRequests').DataTable();
            $('#onlinePaymentPending').DataTable();
            $('#walkinPaymentPending').DataTable();
            $('#noFeesTable').DataTable();
            $('#pendingUsers').DataTable({
                responsive: true
            });
            $('#approvedUsers').DataTable({
                responsive: true
            });
            $('#rejectedUsers').DataTable({
                responsive: true
            });

            $.ajax({
                url: "{{ route('user-pending-count') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Update the badge count with the retrieved count
                    console.log(response.count)
                    $('#pending-registration-count').text(response.count);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            $('.toggle-expand').on('click', function() {
                var row = $(this).closest('.expandable-row');
                var content = row.find('.expandable-content');
                content.toggle();
            });
        });

        // export appointment records to excel
        // $('#export-app-records').on('click', function() {
        //     // Get HTML table data
        //     var table = document.getElementById("appointmentRecords");
        //     // Remove the last column from the table
        //     var rows = table.rows;
        //     for (var i = 0; i < rows.length; i++) {
        //         rows[i].deleteCell(-1);
        //     }
        //     // Convert table data to workbook
        //     var wb = XLSX.utils.table_to_book(table);
        //     // Save data to Excel file
        //     XLSX.writeFile(wb, "appointment-records.xlsx");
        // });
        // $('#export-app-records').on('click', function () {
        //     var table = document.getElementById("appointmentRecords");
        //     var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet 1", raw: true });
        //     var csv = XLSX.utils.sheet_to_csv(wb.Sheets["Sheet 1"]);
        //     var blob = new Blob([csv], { type: "text/csv;charset=utf-8" });
        //     saveAs(blob, "appointment-records.csv");
        // });
        $('#export-app-records').on('click', function() {
            var table = document.getElementById("appointmentRecords");

            // Clone the table and modify the date format
            var clonedTable = table.cloneNode(true);
            var rows = clonedTable.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var dateCell = rows[i].getElementsByTagName("td")[
                    5]; // Assuming the date is in the 6th column (index 5)
                var dateString = dateCell.innerText;
                var date = new Date(dateString);
                var formattedDate = formatDate(date); // Format the date using the desired format
                dateCell.innerText = formattedDate;
            }

            // Remove the last column (View column) from the cloned table
            var headerRow = clonedTable.getElementsByTagName("tr")[0];
            headerRow.removeChild(headerRow.lastElementChild);
            for (var i = 1; i < rows.length; i++) {
                rows[i].removeChild(rows[i].lastElementChild);
            }

            // Convert the modified table to workbook and export as CSV
            var wb = XLSX.utils.table_to_book(clonedTable, {
                sheet: "Sheet 1",
                raw: true
            });
            var csv = XLSX.utils.sheet_to_csv(wb.Sheets["Sheet 1"]);
            var blob = new Blob([csv], {
                type: "text/csv;charset=utf-8"
            });
            saveAs(blob, "appointment-records.csv");
        });

        // Function to format the date as 'M d, Y h:i A'
        function formatDate(date) {
            var options = {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            };
            return date.toLocaleDateString('en-US', options);
        }

        const backToTopBtn = document.querySelector("#back-to-top-btn");

        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 100) {
                backToTopBtn.classList.add("show");
                backToTopBtn.classList.remove("hide");
            } else {
                backToTopBtn.classList.add("hide");
                backToTopBtn.classList.remove("show");
            }
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
        var menu_btn = document.querySelector("#menu-btn");
        var sidebar = document.querySelector("#sidebar");
        var container = document.querySelector(".content-container");
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav");
            container.classList.toggle("active-cont");
        });
    </script>

    <script>
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
    @include('subadmin-cashier-dashboard.modal.incomplete-remarks')

</body>

</html>
