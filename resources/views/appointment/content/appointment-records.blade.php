@extends('appointment.appointment')

@section('content')
    <div class="appointment-records" id="appointment-records">
        <div class="appointment-records-head">
            <p class="display-6 font-mont font-bold">Appointment Records</p>
        </div>
            <div class="appointment-records-lists mb-1">
                @if(count($pending_appointments) > 0)
                <div class="accordion accordion-flush" id="appointment_record_list">
                    @foreach($pending_appointments as $appointment)
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
                                        @if($appointment->status === 'Confirmed Payment' || $appointment->status === 'Pending')
                                            <span style="color: #4a7453;"><i><b> Pending</b></i></span>
                                        @elseif($appointment->status == 'On Process')
                                            <span style="color: #3c8fad;"><i><b> On Process</b></i></span>
                                        @elseif($appointment->status == 'Ready to Claim')
                                            <span style="color: #c18930;"><i><b> Ready to Claim</b></i></span>
                                        @elseif($appointment->status == 'Claimed')
                                            <span style="color: maroon;"><i><b> Claimed</b></i></span>
                                        @endif
                                        </p>
                                    </div>
                                    @if ($appointment->status === 'Pending')
                                    <button id="cancel_app" class="btn cancel_app d-flex flex-row align-items-center col-md-6 w-auto flex-auto" type="button" data-bs-toggle="modal" data-bs-target="#cancelAppointmentModal" data-app-id="{{ $appointment->id }}">
                                        <img src="images/cancel.png" alt="cancel appointment">
                                        <p class="p-0 m-0">Cancel Appointment</p>
                                    </button>
                                    @endif
                                </div>
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
                    <p>You have no bookings at the moment.</p>
                </div>
            @endif
        </div>
    </div>
@endsection