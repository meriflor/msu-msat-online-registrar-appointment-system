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
    

        // $app_id = $request->app_id;
        // $payment_status = $request->payment_status;
        // $or_number = $request->or_number;
        // $bookings = Booking::with('appointment')->find($app_id);
        // if($payment_status == "incomplete"){
        //     $bookings->appointment->payment_status = "Incomplete";
        //     $bookings->appointment->save();

        //     $notif_type = "Incomplete Payment";
        //     $remarks = $request->input('remarks');
        //     $notification = new IncompletePaymentNotif($remarks, $app_id, $notif_type);
        //     $bookings->user->notify($notification);
        // }else{
        //     $existingNotification = $bookings->user->notifications()
        //         ->where('data->app_id', $app_id)
        //         ->where('data->notif_type', 'Incomplete Payment')
        //         ->first();
        //     if($existingNotification){
        //         $existingNotification->delete();
        //     }
        //     $bookings->or_number = $or_number;
        //     $bookings->appointment->payment_status = "Approved";
        //     $bookings->appointment->date_approved = now();
        //     $bookings->appointment->save();
        //     $bookings->save();

        //     $notif_type = "Approved Payment";
        //     $remarks = "
        //     <pre class='font-mont p-3'>
        //         We are pleased to inform you that your payment for the requested document has been successfully approved.</br>
        //         Now that your payment has been approved, we would like to inform you that the next step in the document request process will be handled by the Registrar's Office. They will carefully process your request and work towards fulfilling it as soon as possible. Kindly note that further notices and updates regarding your document will be provided by the Registrar's Office.</br>
        //         In the meantime, we kindly request your patience and understanding. The Registrar's Office will keep you informed about the progress of your document request. Should you have any questions or require any assistance, please feel free to reach out to the Registrar's Office.</br>
        //         We appreciate the opportunity to assist you, and we look forward to delivering the requested document to you in a timely manner.
        //     </pre>
        //     ";
        //     $notification = new IncompletePaymentNotif($remarks, $app_id, $notif_type);
        //     $bookings->user->notify($notification);
        // }
        
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
