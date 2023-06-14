<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin-Cashier | MSU-MSAT Registrar's Online Appointment System</title>

        <!-- bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
            crossorigin="anonymous"
        />
        <link rel="icon" type="image/png" href="{{ asset('images/msat-logo.png') }}">
        <!-- <link rel="stylesheet" href="{{ asset('css/admin/navbar.css') }}"  /> -->
        <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}"  />
        <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/display.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/message.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/forms.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/announcement.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/modal.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/settings.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/defaultcss/pagination.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/defaultcss/calendar.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/admin/subadmin-cashier/navbar.css') }}" />
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
        <nav class="navbar navbar-expand-lg pt-5 pb-3 bg-dark" data-bs-theme="dark">
            <div class="container">
                <div class="navbar-brand d-flex flex-row m-0 pe-4 align-items-center">
                    <div class="logo" style="width: 40px; height: 40px;">
                        <img
                            class="image-fluid"
                            src="{{ asset('images/msat-logo.png') }}"
                            alt=""
                        />
                    </div>
                    <p class="text-wrap font-nun font-white ps-2 m-0">
                        University Cashier
                    </p>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cashierNavbar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="cashierNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="/dashboard-admin-cashier/dashboard" class="nav-link {{ Request::is('dashboard-admin-cashier/dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard-admin-cashier/approved-payments" class="nav-link {{ Request::is('dashboard-admin-cashier/approved-payments') ? 'active' : '' }}">
                                Approved Payments
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/dashboard-admin-cashier/incomplete-payments" class="nav-link {{ Request::is('dashboard-admin-cashier/incomplete-payments') ? 'active' : '' }}">
                                Incomplete Payments
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container py-5">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="{{ asset('js/subadmin-cashier/info-display.js') }}"></script>
        <script src="{{ asset('js/admin/appointment/info-display.js') }}"></script>
        <script src="{{ asset('js/subadmin-cashier/approve-incomplete.js') }}"></script>

        <script>  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>
            //sorting datable
            $('#onlineptable').DataTable();
            $('#walkintable').DataTable();

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
                window.scrollTo({ top: 0, behavior: "smooth" });
            });
        </script>

        <script>
            var url = "{{ url('') }}";
        </script>
        
        <!-- todo modals -->
        @include('subadmin-cashier-dashboard.modal.proof-of-payment')
        @include('admin-dashboard.modal.info')
        @include('subadmin-cashier-dashboard.modal.approve')
        @include('subadmin-cashier-dashboard.modal.incomplete')
        @include('subadmin-cashier-dashboard.modal.incomplete-remarks')
    </body>
</html>
