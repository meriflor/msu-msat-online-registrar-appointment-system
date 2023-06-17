<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\IncompletePaymentNotif;
use App\Notifications\ApprovedPaymentNotif;

class SubadminCashierController extends Controller
{
    public function viewCashierDashboard(){
        $online_payment = Payment::whereHas('appointment', function ($query){
                            $query->where('payment_status', 'Pending')
                                ->where('payment_method', 'Gcash');
                        })->get();
        $walkin_payment = Payment::whereHas('appointment', function ($query){
                            $query->where('payment_status', 'Pending')
                                    ->where('payment_method', 'Walk-in');
                                    })->get();
        return view(
            'subadmin-cashier-dashboard.content.dashboard', 
            compact(
                'online_payment',
                'walkin_payment'
                )
            );
    }

    public function viewCashierApproved(){
        $online_payment = Payment::whereHas('appointment', function ($query){
                    $query->where('payment_status', 'Approved')
                            ->where('payment_method', 'Gcash');
                            })->get();
        $walkin_payment = Payment::whereHas('appointment', function ($query){
                    $query->where('payment_status', 'Approved')
                            ->where('payment_method', 'Walk-in');
                            })->get();
        return view('subadmin-cashier-dashboard.content.approved-payments', compact('online_payment', 'walkin_payment'));
    }

    public function viewCashierIncomplete(){
        $bookings_onlinep = Booking::whereHas('appointment', function ($query) {
                                    $query->where('payment_status', 'Incomplete')->where('payment_method', 'Gcash');
                                })->get();
        $bookings_walkinp = Booking::whereHas('appointment', function ($query) {
                                    $query->where('payment_status', 'Incomplete')->where('payment_method', 'Walk-in');
                                })->get();
        return view('subadmin-cashier-dashboard.content.incomplete-payments', compact('bookings_onlinep', 'bookings_walkinp'));
    }

    public function updatePaymentStatus(Request $request){
        $payment_id = $request->payment_id;
        $payment = Payment::find($payment_id);
        if ($request->hasFile('or_file_path')) {
            $or_file_path = $request->file('or_file_path');
            if ($or_file_path->isValid()) {
                $timestamp = time();
                $fileName = $timestamp . '_' . $or_file_path->getClientOriginalName();
                $pop_path = $or_file_path->move(public_path('images/or-files'), $fileName);
                $payment->or_file_path = 'images/or-files/'.$fileName;
            } else {
                return response()->json(['error' => 'Invalid file'], 400);
            }
        } else {
                $payment->or_file_path = null;
        }
        // todo update statuses
        $payment->appointment->payment_status = "Approved";
        $payment->appointment->date_approved = now();
        $payment->appointment->save();
        $payment->save();

        $app_id = $payment->appointment->id;
        $notif_type = "Approved Payment";
        $remarks = "
        <pre class='font-mont p-3'>
            Your payment has been approved. We will now proceed with the processing of your documents. Please stay tuned for further updates and notifications.
        </pre>
        ";
        $notification = new ApprovedPaymentNotif($remarks, $app_id, $notif_type);
        $payment->appointment->user->notify($notification);
        return back();
    }

    public function getIncompleteRemarks($id){
        $booking = Booking::find($id);
        $user = $booking->user;
        $user_id = $user->id;

        $notifications = $user->notifications()
                    ->where('notifiable_id', $user_id)
                    ->where('data->app_id', $id)
                    ->where('data->notif_type', 'Incomplete Payment')
                    ->first();
        if ($notifications) {
            $remarks = $notifications->data['remarks'];
        } else {
            $remarks = null;
        }
    
        return response()->json([
            'remarks' => $remarks
        ]);
    }
}
