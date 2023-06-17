@extends('subadmin-dashboard.admin')

@section('content')
<div class="d-flex flex-row align-items-center mb-3">
    <a class="btn d-flex flex-row align-items-center" id="menu-btn">
        <img src="/images/back-arrow.png" alt="" />
        <p class="m-0 p-0 font-nun fs-6 ms-2" id="page-title">
            Processed Documents
        </p>
    </a>
</div>
<nav class="navigation this-box mb-3">
    <ul class="font-nun small-nav">
        <li><a href="#pending">Pending</a></li>
        <li><a href="#onprocess">On Process</a></li>
        <li><a href="#readytoclaim">Ready to Claim</a></li>
    </ul>
</nav>

<!-- review ===================pending================================================== -->
<div class="row d-flex flex-row m-2 font-nun" id="pending">
    <div class="appointment-records p-4">
        <div class="w-100 fs-2 font-bold mb-0">Pending Requests</div>
        <small class="mb-2">Requests that need to be processed.</small>
        @if(count($pending)>0)
        <div class="table-rounded">
            <table id="onlinePaymentPending" class="table font-nun hover display compact cell-border">
                <thead class="table-head text-center">
                    <tr>
                        <th>Appointment No.</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Document Requested</th>
                        <th>Date Requested</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($pending as $request)
                        <tr class="text-center">
                            <td>{{ $request->booking_number }}</td>
                            <td>{{ $request->user->school_id }}</td>
                            <td>{{ $request->user->lastName . ", " . $request->user->firstName . " " . substr($request->user->middleName, 0, 1) . ". ". $request->user->suffix }}</td>
                            <td>{{ $request->form->name}}</td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="dropdown d-flex flex-column justify-contents-center">
                                    <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                        <li>
                                            <a  type="button" class="dropdown-item view-request accept-btn" id="accept-btn" data-accept-id="{{ $request->id }}">
                                                Start Process
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.4);"></li>
                                        <li>
                                            <a type="button" class="dropdown-item view-request view-btn" id="{{ $request->id }}">
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a type="button" class="dropdown-item view-request remarks-btn" id="{{ $request->id }}" data-remarks-id="{{ $request->id }}" data-remarks-first="{{ $request->user->firstName }}" data-remarks-last="{{ $request->user->lastName }}" data-remarks-form="{{ $request->form->name }}">
                                                Remarks
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center font-nun">There are no pending requests that need to be processed at the moment.</div>
        @endif
    </div>
</div>
<!-- review ======================================= on process=========================================== -->

<div class="row d-flex flex-row m-2 mt-5" id="onprocess">
    <div class="appointment-records p-4">
        <div class="w-100 fs-2 font-bold font-nun mb-2">On Process Documents</div>
        <small class="mb-2">Documents that are currently being processed.</small>
        <div class="table-rounded">
            <table id="onProcessDocuments" class="table font-nun hover display compact row-border">
                <thead class="table-head text-center">
                    <tr>
                        <th>Appointment Number</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Document Requested</th>
                        <th>Date Requested</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                        @foreach ($onprocess as $request)
                        <tr class="text-center">
                            <td>{{ $request->booking_number }}</td>
                            <td>{{ $request->user->school_id }}</td>
                            <td>{{ $request->user->firstName }}</td>
                            <td>{{ $request->user->lastName }}</td>
                            <td>{{ $request->form->name}}</td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="dropdown d-flex flex-column justify-contents-center">
                                    <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                        <li>
                                            <a  type="button" class="dropdown-item view-request done-btn"  id="done-btn" data-done-id="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#status_appointment_modal">
                                                Done
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.4);"></li>
                                        <li>
                                            <a type="button" class="dropdown-item view-request view-btn" id="{{ $request->id }}">
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a type="button" class="dropdown-item view-request remarks-btn" id="{{ $request->id }}" data-remarks-id="{{ $request->id }}" data-remarks-first="{{ $request->user->firstName }}" data-remarks-last="{{ $request->user->lastName }}" data-remarks-form="{{ $request->form->name }}">
                                                Remarks
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ====================ready to claim ============================================================= -->

<div class="row d-flex flex-row m-2 mt-5" id="readytoclaim">
    <div class="appointment-records p-4">
        <div class="w-100 fs-2 font-bold font-nun mb-2">Ready to Claim Documents</div>
        <div class="table-rounded">
            <table id="readyToClaimDocuments" class="table font-nun hover display compact row-border">
                <thead class="table-head text-center">
                    <tr>
                        <th>Appointment Number</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Document Requested</th>
                        <th>Date Requested</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                        @foreach ($ready as $request)
                        <tr class="text-center">
                            <td>{{ $request->booking_number }}</td>
                            <td>{{ $request->user->school_id }}</td>
                            <td>{{ $request->user->firstName }}</td>
                            <td>{{ $request->user->lastName }}</td>
                            <td>{{ $request->form->name}}</td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td>
                                <!-- fix cuurently in ready to claim document,, updateing sattus or setting appointment to user notif -->
                                <div class="dropdown d-flex flex-column justify-contents-center">
                                    <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                        @if($request->appointment_date != null)
                                        <li>
                                            <a  type="button"  class="dropdown-item view-request claimed-btn"  id="claimed-btn" data-claimed-id="{{ $request->id }}" data-bs-toggle="modal" data-bs-target="#status_appointment_modal">
                                                Claimed
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.4);"></li>
                                        @endif
                                        <li>
                                            <a type="button" class="dropdown-item view-request view-btn" id="{{ $request->id }}">
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a type="button" class="dropdown-item view-request remarks-btn" id="{{ $request->id }}" data-remarks-id="{{ $request->id }}" data-remarks-first="{{ $request->user->firstName }}" data-remarks-last="{{ $request->user->lastName }}" data-remarks-form="{{ $request->form->name }}">
                                                Remarks
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




<button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>

<!-- review -->

<script src="{{ asset('js/admin/appointment/status-button.js') }}"></script>
<script src="{{ asset('js/admin/appointment/info-display.js') }}"></script>
<script src="{{ asset('js/admin/appointment/remarks.js') }}"></script>
<script>
    var url = "{{ url('') }}";
    // review
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $('#acceptApp').on('click', function(event){
            var id = $('#app_id').val();
            var status = $('#accept_status').val();
            console.log(id);
            console.log(status);
            
            $.ajax({
                url: "{{ route('update.status') }}",
                method: "POST",
                data: { 
                    id: id,
                    status: status
                },
                headers: {
                    'X-HTTP-Method-Override': 'PUT' // Set the request method to PUT
                },
                success: function(response){
                    // do something on success
                    console.log(response);
                    location.reload();
                },
                error: function(xhr){
                    // do something on error
                    console.log(xhr.responseText);
                }
            });
            $('#status_appointment_modal').modal('hide');
        });
        $('#doneApp').on('click', function(event){
            var id = $('#app_id').val();
            var status = $('#done_status').val();
            var update = $("input[name='readytoclaim_check']:checked").val();
            console.log(id);
            console.log(status);
            console.log(update);
            $.ajax({
                url: "{{ route('update.status') }}",
                method: "POST",
                data: { 
                    id: id,
                    status: status,
                    update: update
                },
                headers: {
                    'X-HTTP-Method-Override': 'PUT' // Set the request method to PUT
                },
                success: function(response){
                    // do something on success
                    console.log(response);
                    location.reload();
                },
                error: function(xhr){
                    // do something on error
                    console.log(xhr.responseText);
                }
            });
            $('#status_appointment_modal').modal('hide');
        });
        $('#claimedApp').on('click', function(event){
            var id = $('#app_id').val();
            var status = $('#claimed_status').val();
            console.log(id);
            console.log(status);
            $.ajax({
                url: "{{ route('update.status') }}",
                method: "POST",
                data: { 
                    id: id,
                    status: status
                },
                headers: {
                    'X-HTTP-Method-Override': 'PUT' // Set the request method to PUT
                },
                success: function(response){
                    // do something on success
                    console.log(response);
                    location.reload();
                },
                error: function(xhr){
                    // do something on error
                    console.log(xhr.responseText);
                }
            });
            $('#status_appointment_modal').modal('hide');
        });
    });
</script>

@endsection