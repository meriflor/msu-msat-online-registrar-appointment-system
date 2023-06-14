@extends('subadmin-cashier-dashboard.subadmin-cashier')

@section('content')
    <div class="fs-2 font-bold font-nun mb-4" style="flex:1;">
        Approved Payments
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
                    <th>Official Receipt</th>
                    <th>Date Approved</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($online_payment as $payment)
                <tr class="text-center">
                    <td>{{ $payment->appointment->booking_number }}</td>
                    <td>{{ $payment->appointment->user->school_id }}</td>
                    <td>{{ $payment->appointment->user->lastName . ", " . $payment->appointment->user->firstName . " " . substr($payment->appointment->user->middleName, 0, 1) . ". ". $payment->appointment->user->suffix }}</td>
                    <td>{{ $payment->appointment->form->name }}</td>
                    <td>{{ $payment->appointment->num_copies }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->appointment->created_at)->format('F d, Y') }}</td>
                    @if($payment->appointment->payment_method === "Walk-in")
                    <td>{{ $payment->appointment->payment_method }}</td>
                    @else
                    <td style="background-color: #e5f3ff;" class="align-middle">{{ $payment->appointment->payment_method }}</td>
                    @endif
                    <td>
                        <a
                            type="button"
                            class="btn sub-admin-btn view-btn-pop"
                            id="{{ $payment->payment_id }}"
                            >View
                        </a>
                    </td>
                    <td>
                        <a
                            type="button"
                            class="btn sub-admin-btn"
                            href="{{ url($payment->or_file_path) }}" target="_blank"
                            >View
                        </a>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($payment->appointment->date_approved)->format('F d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="w-100 text-center">There's no approved payments yet.</div>
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
                    <th>Date Approved</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($walkin_payment as $payment)
                <tr class="text-center">
                    <td>{{ $payment->appointment->booking_number }}</td>
                    <td>{{ $payment->appointment->user->school_id }}</td>
                    <td>{{ $payment->appointment->user->lastName . ", " . $payment->appointment->user->firstName . " " . substr($payment->appointment->user->middleName, 0, 1) . ". ". $payment->appointment->user->suffix }}</td>
                    <td>{{ $payment->appointment->form->name }}</td>
                    <td>{{ $payment->appointment->num_copies }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->appointment->created_at)->format('F d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->appointment->date_approved)->format('F d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="w-100 text-center">There's no approved payments yet.</div>
        @endif
    </div>
    
    <button id="back-to-top-btn" class="btn btn-custom show" style="color: #131313;">Back to top</button>
@endsection