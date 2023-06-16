@extends('appointment.appointment')

@section('content')
    <div class="appointment-records font-mont" id="appointment-records">
        <div class="appointment-records-list">
            @if(count($pending) > 0)
            <div>
                <p class="fs-2 font-bold m-3 mx-0">Pending Request</p>
                <div class="accordion accordion-flush" id="request_record_list">
                    @foreach($pending as $appointment)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#req-rec-{{ $appointment->id }}" aria-expanded="false" aria-controls="{{ $appointment->id }}">
                                {{ $appointment->form->name }}: {{ $appointment->created_at->format('M d, Y h:i A') }}
                        </h2>
                        <div id="req-rec-{{ $appointment->id }}"  class="accordion-collapse collapse" data-bs-parent="#request_record_list" >
                            <div class="accordion-body">
                                <div class="d-flex flex-row align-items-center row">
                                    <div class="col-md-6" style="flex: 1;">
                                        <p class="fs-6 m-0"><b>Status: </b>
                                        @php
                                            $has_resched = false;
                                            $has_remarks = false;
                                            foreach($bookings as $booking) {
                                                if($booking->appointment_id == $appointment->id && $booking->resched == 1) {
                                                    $has_resched = true;
                                                    $has_remarks = true;
                                                    $remarks = $booking->appointment->remarks;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if($has_resched)
                                            <span style="color: #f3f3f3; background-color: maroon;"><i><b>Reschedule</b></i></span>
                                        @else
                                            @if($appointment->status === 'Confirmed Payment' || $appointment->status === 'Pending')
                                                <span style="color: #4a7453;"><i><b> Pending</b></i></span>
                                            @elseif($appointment->status == 'On Process')
                                                <span style="color: #3c8fad;"><i><b> On Process</b></i></span>
                                            @elseif($appointment->status == 'Ready to Claim')
                                                <span style="color: #c18930;"><i><b> Ready to Claim</b></i></span>
                                            @elseif($appointment->status == 'Claimed')
                                                <span style="color: maroon;"><i><b> Claimed</b></i></span>
                                            @endif
                                        @endif
                                            <!-- {{ $appointment->status }} -->
                                        </p>
                                    </div>
                                    @if ($appointment->status === 'Pending')
                                    <button id="cancel_app" class="btn cancel_app d-flex flex-row align-items-center col-md-6 w-auto flex-auto" type="button" data-bs-toggle="modal" data-bs-target="#cancelAppointmentModal" data-app-id="{{ $appointment->id }}">
                                        <img src="images/cancel.png" alt="cancel appointment">
                                        <p class="p-0 m-0">Cancel Appointment</p>
                                    </button>
                                    @endif
                                </div>
                                @if($has_remarks)
                                    <div class="d-flex flex-row p-2 mt-4" style="background-color: #80000021; border: 1px solid maroon;">
                                        <p class="m-0 p-0">REMARKS: <span class="m-0 p-0">{{ $remarks }}</span></p>

                                    </div>
                                @endif
                                <div class="receipt-box p-3 my-3" id="my-div-{{ $appointment->id }}">
                                    <div class="receipt-content fs-6 d-flex flex-column font-mont">
                                        <div class="receipt-overlay">
                                            <img src="/images/msat-logo.png" class="receipt-logo">
                                        </div>
                                        <div class="content-head d-flex flex-column">
                                            <small class="font-bold">Mindanao State University - Maigo School of Arts and Trades</small>
                                            <small>msumsat.edu.ph</small>
                                        </div>
                                        <div class="content-body mt-5">
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Date Filled: </small>
                                                <small>{{ $appointment->created_at->format('M d, Y h:i A') }}</small>
                                            </div>
                                            @if($appointment->appointment_date != null)
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Appointment Date: </small>
                                                <small>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</small>
                                            </div>
                                            @endif
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Client Name: </small>
                                                <small>{{ $appointment->user->firstName }} {{ $appointment->user->middleName }} {{ $appointment->user->lastName }} {{ $appointment->user->suffix }}</small>
                                            </div>
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Request No.: </small>
                                                <small>{{ $appointment->booking_number }}</small>
                                            </div>
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Email: </small>
                                                <small>{{ $appointment->user->email }}</small>
                                            </div>
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Document Requested: </small>
                                                <small class="">{{ $appointment->form->name }}</small>
                                            </div>
                                            @if($appointment->num_copies > 1)
                                            <div class="d-flex flex-wrap m-0 p-0">
                                                <small class="font-bold me-1">Copies Requested: </small>
                                                <small class="">{{ $appointment->num_copies }} copies</small>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="content-foot mt-5 d-flex flex-row align-items-center">
                                            <img src="/images/qrcode.png" alt="">
                                            <div class="d-flex flex-column m-0 p-0">
                                                <small style="font-size: 11px;">*Bring the necessary requirements and additional funds to cover the total amount</small>
                                                <small style="color: red;font-size: 11px;">Kindly take a screenshot of the receipt or access your account to present it to the registrar personnel. Alternatively, you may download and print the document for your reference.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-end">
                                    <button id="download-button" class="btn user-button download-button" data-app-id="{{ $appointment->id }}">Download PDF</button>
                                    <button id="print-button" class="btn user-button ms-3 print-button" data-app-id="{{ $appointment->id }}">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @if(count($pending)>0)
        <hr>
        @endif
        <!-- review claimed or history of requests -->
        <div class="appointment-records-lists mb-1">
            <p class="fs-2 font-bold m-3 mx-0">Document Request History</p>
            @if(count($claimed) > 0)
            <div class="accordion accordion-flush" id="appointment_record_list">
                @foreach($claimed as $appointment)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#app-rec-{{ $appointment->id }}" aria-expanded="false" aria-controls="{{ $appointment->id }}">
                            {{ $appointment->form->name }}: {{ $appointment->created_at->format('M d, Y h:i A') }}
                    </h2>
                    <div id="app-rec-{{ $appointment->id }}"  class="accordion-collapse collapse" data-bs-parent="#appointment_record_list" >
                        <div class="accordion-body">
                            <div class="d-flex flex-row align-items-center row">
                                <div class="col-md-6" style="flex: 1;">
                                    <p class="fs-6 m-0"><b>Status: </b>
                                    @php
                                        $has_resched = false;
                                        $has_remarks = false;
                                        foreach($bookings as $booking) {
                                            if($booking->appointment_id == $appointment->id && $booking->resched == 1) {
                                                $has_resched = true;
                                                $has_remarks = true;
                                                $remarks = $booking->appointment->remarks;
                                                break;
                                            }
                                        }
                                    @endphp
                                    @if($has_resched)
                                        <span style="color: #f3f3f3; background-color: maroon;"><i><b>Reschedule</b></i></span>
                                    @else
                                        @if($appointment->status === 'Confirmed Payment' || $appointment->status === 'Pending')
                                            <span style="color: #4a7453;"><i><b> Pending</b></i></span>
                                        @elseif($appointment->status == 'On Process')
                                            <span style="color: #3c8fad;"><i><b> On Process</b></i></span>
                                        @elseif($appointment->status == 'Ready to Claim')
                                            <span style="color: #c18930;"><i><b> Ready to Claim</b></i></span>
                                        @elseif($appointment->status == 'Claimed')
                                            <span style="color: maroon;"><i><b> Claimed</b></i></span>
                                        @endif
                                    @endif
                                        <!-- {{ $appointment->status }} -->
                                    </p>
                                </div>
                                @if ($appointment->status === 'Pending')
                                <button id="cancel_app" class="btn cancel_app d-flex flex-row align-items-center col-md-6 w-auto flex-auto" type="button" data-bs-toggle="modal" data-bs-target="#cancelAppointmentModal" data-app-id="{{ $appointment->id }}">
                                    <img src="images/cancel.png" alt="cancel appointment">
                                    <p class="p-0 m-0">Cancel Appointment</p>
                                </button>
                                @endif
                            </div>
                            @if($has_remarks)
                                <div class="d-flex flex-row p-2 mt-4" style="background-color: #80000021; border: 1px solid maroon;">
                                    <p class="m-0 p-0">REMARKS: <span class="m-0 p-0">{{ $remarks }}</span></p>

                                </div>
                            @endif
                            <div class="receipt-box p-3 my-3" id="my-div-{{ $appointment->id }}">
                                <div class="receipt-content fs-6 d-flex flex-column font-mont">
                                    <div class="receipt-overlay">
                                        <img src="/images/msat-logo.png" class="receipt-logo">
                                    </div>
                                    <div class="content-head d-flex flex-column">
                                        <small class="font-bold">Mindanao State University - Maigo School of Arts and Trades</small>
                                        <small>msumsat.edu.ph</small>
                                    </div>
                                    <div class="content-body mt-5">
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Date Filled: </small>
                                            <small>{{ $appointment->created_at->format('M d, Y h:i A') }}</small>
                                        </div>
                                        @if($appointment->appointment_date != null)
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Appointment Date: </small>
                                            <small>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</small>
                                        </div>
                                        @endif
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Client Name: </small>
                                            <small>{{ $appointment->user->firstName }} {{ $appointment->user->middleName }} {{ $appointment->user->lastName }} {{ $appointment->user->suffix }}</small>
                                        </div>
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Request No.: </small>
                                            <small>{{ $appointment->booking_number }}</small>
                                        </div>
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Email: </small>
                                            <small>{{ $appointment->user->email }}</small>
                                        </div>
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Document Requested: </small>
                                            <small class="">{{ $appointment->form->name }}</small>
                                        </div>
                                        @if($appointment->num_copies > 1)
                                        <div class="d-flex flex-wrap m-0 p-0">
                                            <small class="font-bold me-1">Copies Requested: </small>
                                            <small class="">{{ $appointment->num_copies }} copies</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="content-foot mt-5 d-flex flex-row align-items-center">
                                        <img src="/images/qrcode.png" alt="">
                                        <div class="d-flex flex-column m-0 p-0">
                                            <small style="font-size: 11px;">*Bring the necessary requirements and additional funds to cover the total amount</small>
                                            <small style="color: red;font-size: 11px;">Kindly take a screenshot of the receipt or access your account to present it to the registrar personnel. Alternatively, you may download and print the document for your reference.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <button id="download-button" class="btn user-button download-button" data-app-id="{{ $appointment->id }}">Download PDF</button>
                                <button id="print-button" class="btn user-button ms-3 print-button" data-app-id="{{ $appointment->id }}">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="appointment-records-lists">
                <p>No records found.</p>
            </div>
        @endif
    </div>
    </div>
@endsection