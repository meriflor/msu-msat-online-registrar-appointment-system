<div class="appointment-records p-4">
    <div class="w-100 fs-2 font-bold font-nun mb-2">Pending Requests</div>
    @if(count($pending)>0)
    <div class="w-100 fs-4 font-nun mb-2 d-flex flex-row align-items-center">
        <div class="logo d-flex me-2">
            <img src="/images/payment-01.png" alt="">
        </div>
        Online Payments
    </div>
    <div class="table-rounded">
        <table id="onlinePaymentPending" class="table font-nun hover display compact cell-border">
            <thead class="table-head text-center">
                <tr>
                    <th>Appointment No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Document Requested</th>
                    <th>Date Requested</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($pending as $booking)
                @if($booking->appointment->payment_method == "GCash")
                    <tr class="text-center">
                        <td>{{ $booking->appointment->booking_number }}</td>
                        <td>{{ $booking->user->school_id }}</td>
                        <td>{{ $booking->user->lastName . ", " . $booking->user->firstName . " " . substr($booking->user->middleName, 0, 1) . ". ". $booking->user->suffix }}</td>
                        <td>{{ $booking->appointment->form->name}}</td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        <td>{{ $booking->appointment->payment_method }}</td>
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
                        <td>
                            <div class="dropdown d-flex flex-column justify-contents-center">
                                <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                    @if($booking->appointment->payment_status != "Pending")
                                    <li>
                                        <a  type="button" class="dropdown-item view-request accept-btn" id="accept-btn" data-accept-id="{{ $booking->appointment->id }}">
                                            Accept
                                        </a>
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
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-100 fs-4 font-nun mb-2 d-flex flex-row align-items-center">
        <div class="logo d-flex me-2">
            <img src="/images/payment-01.png" alt="">
        </div>
        Walk-in Payments
    </div>
    <div class="table-rounded">
        <table id="walkinPaymentPending" class="table font-nun hover display compact cell-border">
            <thead class="table-head text-center">
                <tr>
                    <th>Appointment No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Document Requested</th>
                    <th>Date Requested</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($pending as $booking)
                @if($booking->appointment->payment_method == "Walk-in")
                    <tr class="text-center">
                        <td>{{ $booking->appointment->booking_number }}</td>
                        <td>{{ $booking->user->school_id }}</td>
                        <td>{{ $booking->user->lastName . ", " . $booking->user->firstName . " " . substr($booking->user->middleName, 0, 1) . ". ". $booking->user->suffix }}</td>
                        <td>{{ $booking->appointment->form->name}}</td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
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
                        <td>
                            <div class="dropdown d-flex flex-column justify-contents-center">
                                <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                    @if($booking->appointment->payment_status == "Approved")
                                    <li>
                                        <a  type="button" class="dropdown-item view-request accept-btn" id="accept-btn" data-accept-id="{{ $booking->appointment->id }}">
                                            Accept
                                        </a>
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
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-100 fs-4 font-nun mb-2 d-flex flex-row align-items-center">
        <div class="logo d-flex me-2">
            <img src="/images/payment-01.png" alt="">
        </div>
        No Collection of Fees
    </div>
    <div class="table-rounded">
        <table id="noFeesTable" class="table font-nun hover display compact cell-border">
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
                @foreach ($pending as $booking)
                @if($booking->appointment->payment_method == null)
                    <tr class="text-center">
                        <td>{{ $booking->appointment->booking_number }}</td>
                        <td>{{ $booking->user->school_id }}</td>
                        <td>{{ $booking->user->lastName . ", " . $booking->user->firstName . " " . substr($booking->user->middleName, 0, 1) . ". ". $booking->user->suffix }}</td>
                        <td>{{ $booking->appointment->form->name}}</td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="dropdown d-flex flex-column justify-contents-center">
                                <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e !important;">
                                    <li>
                                        <a  type="button" class="dropdown-item view-request accept-btn" id="accept-btn" data-accept-id="{{ $booking->appointment->id }}">
                                            Accept
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.4);"></li>
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
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="text-center">We haven't received any appointment requests for this day yet.</div>
    @endif
</div>