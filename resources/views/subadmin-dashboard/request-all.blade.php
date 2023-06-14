@extends('subadmin-dashboard.admin')

@section('content')
    <div class="d-flex flex-row align-items-center mb-3">
        <a class="btn btn-custom d-flex flex-row align-items-center" href="/dashboard-admin-appointments/dashboard">
            <img src="/images/back-arrow.png" class="me-3"
            style=" height: 10px;
                    width: 10px;"/>
            Home
        </a>
    </div>
    <div class="row d-flex flex-row m-2">
        <div class="appointment-records p-4">
            <div class="w-100 fs-2 font-bold font-nun mb-2">Appointment Requests</div>
            <div class="table-rounded">
                <table id="appointmentRecords" class="table font-nun hover display compact cell-border">
                    <thead class="table-head text-center">
                        <tr>
                            <th>Appointment No.</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Document Requested</th>
                            <th>Date Requested</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($bookings)>0)
                            @foreach ($bookings as $booking)
                            <tr class="text-center">
                                <td>{{ $booking->appointment->booking_number }}</td>
                                <td>{{ $booking->user->school_id }}</td>
                                <td>{{ $booking->user->lastName . ", " . $booking->user->firstName . " " . substr($booking->user->middleName, 0, 1) . ". ". $booking->user->suffix }}</td>
                                <td>{{ $booking->appointment->form->name}}</td>
                                <td>{{ $booking->created_at->format('M d, Y h:i A') }}</td>
                                @if($booking->appointment->payment_method == "Walk-in")
                                <td>
                                    {{ $booking->appointment->payment_method }}
                                </td>
                                @else
                                <td style="background-color: #e5f3ff;">
                                    {{ $booking->appointment->payment_method }}
                                </td>
                                @endif
                                @if($booking->appointment->payment_status == "Incomplete")
                                <td style="background-color:#E78787;">
                                    <a
                                        type="button"
                                        class="btn sub-admin-btn view-remarks-incomplete"
                                        id="{{ $booking->id }}"
                                        data-app-id="{{ $booking->id }}"
                                        style="box-shadow: 0 0 8px rgba(195,75,75,0.4); color: white;">Incomplete
                                    </a>
                                </td>
                                @elseif($booking->appointment->payment_status == "Approved")
                                <td style="background-color:#B7DEA9;">
                                    {{ $booking->appointment->payment_status }}
                                </td>
                                @else
                                <td style="background-color:white;">
                                    {{ $booking->appointment->payment_status }}
                                </td>
                                @endif
                                <td class="status">{{ $booking->appointment->status }}</td>
                                <td>
                                    <div class="dropdown d-flex flex-column justify-contents-center">
                                        <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                            @if($booking->appointment->payment_status != "Pending")
                                            <li>
                                                @if($booking->appointment->status == "Pending")
                                                <a  type="button" class="dropdown-item view-request accept-btn" id="accept-btn" data-accept-id="{{ $booking->appointment->id }}">
                                                    Accept
                                                </a>
                                                @elseif($booking->appointment->status == "On Process")
                                                <a  type="button" class="dropdown-item view-request done-btn"  id="done-btn" data-done-id="{{ $booking->appointment->id }}" data-bs-toggle="modal" data-bs-target="#status_appointment_modal">
                                                    Done
                                                </a>
                                                @elseif($booking->appointment->status == "Ready to Claim")
                                                <a  type="button"  class="dropdown-item view-request claimed-btn"  id="claimed-btn" data-claimed-id="{{ $booking->appointment->id }}" data-bs-toggle="modal" data-bs-target="#status_appointment_modal">
                                                    Claimed
                                                </a>
                                                @endif
                                            </li>
                                            <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.4);"></li>
                                            @endif
                                            <li>
                                                <a type="button" class="dropdown-item view-request view-btn" id="{{ $booking->id }}">
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <a type="button" class="dropdown-item view-request remarks-btn" id="{{ $booking->id }}" data-remarks-id="{{ $booking->id }}" data-remarks-first="{{ $booking->user->firstName }}" data-remarks-last="{{ $booking->user->lastName }}" data-remarks-form="{{ $booking->appointment->form->name }}">
                                                    Remarks
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                            @endif
                    </tbody>
                </table>
                {{-- <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                    <ul class="pagination font-nun">
                        <li class="page-item{{ ($bookings->currentPage() == 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $bookings->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ ($bookings->currentPage() == 1) ? 'true' : 'false' }}">Previous</a>
                        </li>
                        @for ($i = 1; $i <= $bookings->lastPage(); $i++)
                        <li class="page-item{{ ($bookings->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $bookings->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                        <li class="page-item{{ ($bookings->currentPage() == $bookings->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $bookings->nextPageUrl() }}" aria-disabled="{{ ($bookings->currentPage() == $bookings->lastPage()) ? 'true' : 'false' }}">Next</a>
                        </li>
                    </ul>
                </nav> --}}
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
            $('#acceptApp').on('click', function(event){
                var id = $('#app_id').val();
                var status = $('#accept_status').val();
                console.log(id);
                console.log(status);
                
                $.ajax({
                    url: "{{ url('acceptStatus') }}",
                    method: "PUT",
                    data: { 
                        id: id,
                        status: status
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
        $(document).ready(function(){
            $('#doneApp').on('click', function(event){
                var id = $('#app_id').val();
                var status = $('#done_status').val();
                console.log(id);
                console.log(status);
                $.ajax({
                    url: "{{ url('doneStatus') }}",
                    method: "PUT",
                    data: { 
                        id: id,
                        status: status
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
        $(document).ready(function(){
            $('#claimedApp').on('click', function(event){
                var id = $('#app_id').val();
                var status = $('#claimed_status').val();
                console.log(id);
                console.log(status);
                $.ajax({
                    url: "{{ url('claimedStatus') }}",
                    method: "PUT",
                    data: { 
                        id: id,
                        status: status
                    },
                    success: function(response){
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr){
                        console.log(xhr.responseText);
                    }
                });
                $('#status_appointment_modal').modal('hide');
            });
        });
    </script>
@endsection
