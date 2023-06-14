@extends('subadmin-cashier-dashboard.subadmin-cashier')

@section('content')
    <div class="fs-2 font-bold font-nun mb-4" style="flex:1;">
        Pending Payments
    </div>
    <!-- small navigation -->
    <nav class="navigation this-box mb-3">
        <ul class="font-nun small-nav">
            <li><a href="#online_p">Online Payments</a></li>
            <li><a href="#walkin_p">Walk-in</a></li>
        </ul>
    </nav>
    <div class="p-shad-w p-4 mb-4" id="online_p">
        <h3 class="font-bold font-nun mb-4" style="flex:1;">
            Online Payments
        </h3>
        @if(count($online_payment) > 0)
        <table class="table font-nun hover display compact cell-border" id="onlineptable">
            <thead class="table-head text-center" style="font-size: 0.9rem;">
                <tr>
                    <th>Appointment Number</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Document Requested</th>
                    <th>Copies</th>
                    <th>Date Requested</th>
                    <th>Payment Method</th>
                    <th>Proof of Payment</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($online_payment as $payment)
                <tr class="text-center">
                    <td>{{ $payment->appointment->booking_number }}</td>
                    <td>{{ $payment->appointment->user->school_id }}</td>
                    <td>{{ $payment->appointment->user->lastName . ", " . $payment->appointment->user->firstName . " " . substr($payment->appointment->user->middleName, 0, 1) . ". ". $payment->appointment->user->suffix }}</td>
                    <td >{{ $payment->appointment->form->name }}</td>
                    <td>{{ $payment->appointment->num_copies }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->appointment->created_at)->format('F d, Y') }}</td>
                    @if($payment->payment_method === "Walk-in")
                    <td>{{ $payment->appointment->payment_method }}</td>
                    @else
                    <td style="background-color: #e5f3ff;" class="align-middle">{{ $payment->appointment->payment_method }}</td>
                    @endif
                    <td>
                        @if($payment->proof_of_payment == null)
                        None
                        @else
                        <!-- fix modal no pop up || in the js info-display problem -->
                        <a
                            type="button"
                            class="btn sub-admin-btn view-btn-pop"
                            id="{{ $payment->payment_id }}"
                            >View
                        </a>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown d-flex flex-column justify-contents-center">
                            <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e;">
                                <li><a class="dropdown-item active approve-payment-btn" type="button" data-payment_id="{{ $payment->payment_id }}" id="">Approve Payment</a></li>
                                <!-- <li><a class="dropdown-item incomplete-payment-btn"  type="button" data-app-id="{{ $payment->id }}" id="">Incomplete Payment</a></li> -->
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="w-100 text-center">There are no payments to review.</div>
        @endif
    </div>

    <div class="p-shad-w p-4 mb-5" id="walkin_p">
        <h3 class="font-bold font-nun mb-4" style="flex:1;">
            Walk-in
        </h3>
        @if(count($walkin_payment) > 0)
        <table class="table font-nun hover display compact cell-border" id="walkintable">
            <thead class="table-head text-center" style="font-size: 0.9rem;">
                <tr>
                    <th>Appointment Number</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Document Requested</th>
                    <th>Copies</th>
                    <th>Date Requested</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($walkin_payment as $payment)
                <tr class="text-center">
                    <td>{{ $payment->appointment->booking_number }}</td>
                    <td>{{ $payment->user->school_id }}</td>
                    <td>{{ $payment->user->lastName . ", " . $payment->user->firstName . " " . substr($payment->user->middleName, 0, 1) . ". ". $payment->user->suffix }}</td>
                    <td>{{ $payment->appointment->form->name }}</td>
                    <td>{{ $payment->appointment->num_copies }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->appointment->created_at)->format('F d, Y') }}</td>
                    <td>
                        <div class="dropdown d-flex flex-column justify-contents-center">
                            <button class="btn sub-admin-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #1e1e1e;">
                                <li><a class="dropdown-item active approve-payment-btn" type="button" data-payment_id="{{ $payment->payment_id }}">Approve Payment</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="w-100 text-center">There are no payments to review.</div>
        @endif
    </div>
    
    <button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>
@endsection