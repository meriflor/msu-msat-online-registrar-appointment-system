@extends('subadmin-dashboard.admin')

@section('content')
    <!-- <div class="d-flex flex-row align-items-center mb-3">
        <a class="btn btn-custom d-flex flex-row align-items-center" href="/dashboard-admin-appointments/dashboard">
            <img src="/images/back-arrow.png" class="me-3"
            style=" height: 10px;
                    width: 10px;"/>
            Home
        </a>
    </div> -->
    <div class="d-flex flex-row align-items-center mb-3">
        <a class="btn d-flex flex-row align-items-center" id="menu-btn">
            <img src="/images/back-arrow.png" alt="" />
            <p class="m-0 p-0 font-nun fs-6 ms-2" id="page-title">
                Requests
            </p>
        </a>
    </div>
    <div class="row d-flex flex-row m-2">
        <div class="appointment-records p-4">
            <div class="w-100 fs-2 font-bold font-nun mb-2">Requested Documents</div>
            <div class="table-rounded">
                <table id="requestTable" class="table font-nun hover display compact cell-border">
                    <thead class="table-head text-center">
                        <tr>
                            <th>Request No.</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Document Requested</th>
                            <th>Date Requested</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($requests)>0)
                            @foreach ($requests as $request)
                            <tr class="text-center">
                                <td>{{ $request->booking_number }}</td>
                                <td>{{ $request->user->school_id }}</td>
                                <td>{{ $request->user->lastName . ", " . $request->user->firstName . " " . substr($request->user->middleName, 0, 1) . ". ". $request->user->suffix }}</td>
                                <td>{{ $request->form->name}}</td>
                                <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <div class="dropdown d-flex flex-column justify-contents-center">
                                        <button class="btn sub-admin-btn view-request-document" type="button" aria-expanded="false" id="{{ $request->id }}">
                                            View
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row d-flex flex-row m-2 mt-4">
        <div class="appointment-records p-4">
            <div class="w-100 fs-2 font-bold font-nun mb-2">Pending Payments</div>
            <div class="table-rounded">
                <table id="pendingPaymentTable" class="table font-nun hover display compact cell-border">
                    <thead class="table-head text-center">
                        <tr>
                            <th>Request No.</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Document Requested</th>
                            <th>Date Requested</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($pending_payments)>0)
                            @foreach ($pending_payments as $pending_payment)
                            <tr class="text-center">
                                <td>{{ $pending_payment->booking_number }}</td>
                                <td>{{ $pending_payment->user->school_id }}</td>
                                <td>{{ $pending_payment->user->lastName . ", " . $pending_payment->user->firstName . " " . substr($pending_payment->user->middleName, 0, 1) . ". ". $pending_payment->user->suffix }}</td>
                                <td>{{ $pending_payment->form->name}}</td>
                                <td>{{ $pending_payment->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            @endforeach
                            
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>
    <!-- review -->

    <script src="{{ asset('js/admin/appointment/status-button.js') }}"></script>
    <script src="{{ asset('js/admin/appointment/info-display.js') }}"></script>
    <script>
        var url = "{{ url('') }}";
        // review
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $(document).on("click", ".view-request-document", function() {
                var request_id = $(this).attr("id");
                $("#request_id").val(request_id);
                $.ajax({
                    url: "/requested/" + request_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        
                        $("#req_fullName_text").text(data.fullName);
                        $("#req_doc_name_text").text(data.doc_name);
                        $("#req_date_req_text").text(data.req_date);
                        $("#req_purpose_text").text(data.req_purpose);

                        if(data.req_copies == 1){
                            $("#req_copies_text").text(data.req_copies + " copy");
                        }else{
                            $("#req_copies_text").text(data.req_copies + " copies");
                        }

                        if(data.acad_year != null){
                            $("#req_acad_year").show();
                            $("#req_acad_year_text").text(data.acad_year);
                        }else{
                            $("#req_acad_year").hide();
                            $("#req_acad_year_text").text("");
                        }

                        var requirements = data.requirements;
                        console.log('requirements: '+requirements);
                        if (requirements.length > 0) {
                            $("#requirements_info_div").show();
                            var requirementsHtml = '';
                            data.requirements.forEach(function (requirement) {
                                var fileName = requirement.file_name;
                                var baseUrl = window.location.origin; // Get the base URL
                                var fileLink = baseUrl + '/' + requirement.file_path;
                                requirementsHtml += '<tr class="font-nun">';
                                requirementsHtml += '<td>' + fileName + '</td>';
                                requirementsHtml += '<td><a href="' + fileLink + '" target="_blank" class="btn btn-primary font-nun" style="background-color: #1e1e1e; color:white; border:none;">View</a></td>';
                                requirementsHtml += '</tr>';
                            });
                            $("#requirementsTable tbody").html(requirementsHtml);
                        } else {
                            $("#requirements_info_div").hide();
                        }
                        $('#info_request_modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                    // Handle the error
                    }
                });
            });
        });
    </script>
@endsection
