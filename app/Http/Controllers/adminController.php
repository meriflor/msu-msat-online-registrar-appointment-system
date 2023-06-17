<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\Announcement;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Requirement;
use App\Models\RegistrarStaff;
use App\Models\WebsiteImageContent;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

use Illuminate\Support\Facades\DB;

use App\Notifications\AppRemarksUpdate;
use App\Notifications\ConfirmedPaymentNotification;
use App\Notifications\SetAppointmentNotification;
use App\Notifications\ReuploadRequirementsNotification;

class adminController extends Controller
{
    public function viewApp($id){
        $booking = Booking::with('user', 'appointment.form')->findOrFail($id);
        $fullName = $booking->user->lastName . ', ' . $booking->user->firstName;
        if ($booking->user->middleName) {
            $fullName .= ' ' . $booking->user->middleName;
        }if ($booking->user->suffix) {
            $fullName .= ' ' . $booking->user->suffix;
        }
        $requirements = Requirement::where('booking_id', $id)->get(['file_name', 'file_path']);

        $fileNames = [];
        foreach ($requirements as $requirement) {
            $fileName = basename($requirement->file_name);
            $filePath = $requirement->file_path;
            $fileNames[] = [
                'file_name' => $fileName,
                'file_path' => $filePath,
            ];
        }
        return response()->json([
            'fullName' => $fullName,
            'address' => $booking->user->address,
            'school_id' => $booking->user->school_id,
            'cell_no' => $booking->user->cell_no,
            'civil_status' => $booking->user->civil_status,
            'email' => $booking->user->email,
            'birthdate' => Carbon::parse($booking->user->birthdate)->format('F j, Y'),
            'status' => $booking->user->status,
            'gender' => $booking->user->gender,
            'course' => $booking->user->course,
            'acadYear' => $booking->user->acadYear,
            'gradYear' => $booking->user->gradYear,

            'app_purpose' => $booking->appointment->app_purpose,
            'doc_req_year' => $booking->appointment->acad_year,
            'doc_name' => $booking->appointment->form->name,
            'doc_created' => Carbon::parse($booking->user->created_at)->format('F j, Y'),
            'appointment_date' => $booking->appointment->appointment_date,
            'booking_number' => $booking->appointment->booking_number,
            'a_transfer' => $booking->appointment->a_transfer,
            'a_transfer_school' => $booking->appointment->a_transfer_school,
            'b_transfer' => $booking->appointment->b_transfer,
            'b_transfer_school' => $booking->appointment->b_transfer_school,
            'remarks' => $booking->appointment->remarks,

            'doc_fee' => $booking->appointment->form->fee,
            'payment_method' => $booking->appointment->payment_method,
            'proof_of_payment' => $booking->appointment->proof_of_payment,
            'reference_number' => $booking->appointment->reference_number,
            'requirements' => $fileNames
        ]);
    }

    public function updateStatus(Request $request){
        $request_info = Appointment::find($request->id);
        if($request->status == "On Process"){
            $request_info->status = $request->status;
        }else if($request->status == "Ready to Claim"){
            if($request->update == "claimed"){
                $request_info->status = "Claimed";
            }else if($request->update == "setAppointment"){
                $request_info->status = "Ready to Claim";
                $remarks = "We're pleased to inform you that your requested document is now prepared and awaiting collection. To claim it, please schedule an appointment with the registrar's office. Kindly remember to bring any additional requirements, if applicable, as indicated for the requested document. Thank you!";
                $notification = new SetAppointmentNotification($remarks, $request->id, "Set Appointment");
                $request_info->user->notify($notification);
            }
            // fix the display and flow of the claimed and set appointment where to display the data
        }else if ($request->status == "Claimed"){
            $request_info->status = $request->status;
        }
        $request_info->save();
    }

    //review =================================== Revised =================================================================
    public function viewAdminRecords(Request $request){
        $bookings = Appointment::where('status', 'claimed')->get();
        $current_day = Carbon::today()->format('Y-m-d');
        $todayDocs = Appointment::with('form')->where('appointment_date', '=', $current_day)->get();
        
        $futureDocs = Appointment::with('form')
                ->where('appointment_date', '!=', null)
                ->where('appointment_date', '>',  $current_day)
                ->where('status', 'Ready to Claim')
                ->whereHas('bookings', function ($query) {
                    $query->where('resched', 0);
                })
                ->orderBy('appointment_date', 'asc')
                ->get()
                ->groupBy(function ($appointment) {
                    return Carbon::createFromFormat('Y-m-d', $appointment->appointment_date)->toDateString();
                });

        $formFutureCounts = collect([]);

        foreach ($futureDocs as $date => $appointments) {
            $counts = $appointments->groupBy('form.name')->map(function ($appointments) {
                return $appointments->count();
            });


            $formFutureCounts = $formFutureCounts->merge($counts->map(function ($count, $formName) use ($date) {
                return [ 
                    'form_name' => $formName,
                    'date' => $date,
                    'count' => $count
                ];
            }));
        }


        $formFutureCounts = $formFutureCounts->groupBy('form_name');
        
        $formCounts = $todayDocs->groupBy('form.name')->map(function ($appointments) {
            return $appointments->count();
        });

        $pendingRequests = Appointment::where('status', 'Pending')
                            ->where('payment_status', 'Requesting')
                            ->get();
        $processedDocs = Appointment::whereNotIn('status', ['Claimed', 'Ready to Claim'])
                            ->get();
        $requests = Appointment::where('status', 'Pending')
                    ->where('payment_status', 'Requesting')
                    ->get();
        $filteredRequests = [];
        foreach ($requests as $request) {
            $notification = DB::table('notifications')
                ->where('data->notif_type', 'Re-upload Requirements')
                ->where('data->app_id', $request->id)
                ->where('data->uploaded', 0)
                ->first();

            if (!$notification) {
                $filteredRequests[] = $request;
            }
        }
        
        return view('admin-dashboard.dashboard', compact('bookings', 'todayDocs', 'futureDocs', 'current_day', 'formCounts', 'pendingRequests', 'processedDocs', 'filteredRequests'));
    }


        
    //review ========================Returning Pending Request with Specific Date====================================
    public function viewAdminRequest(Request $request, $date){
        $selectedDate = Carbon::parse($date)->format('Y-m-d');
        $thisDay = Carbon::parse($date)->format('F d, Y');

        $ready = Booking::with('user', 'appointment')
                        ->where('resched', 0)
                        ->whereHas('appointment', function($query) use($selectedDate){
                            $query->where('appointment_date', $selectedDate)->where('status', 'Ready to Claim');
                        })->get();

        $claimed = Booking::with('user', 'appointment')
                        ->where('resched', 0)
                        ->whereHas('appointment', function($query) use($selectedDate){
                            $query->where('appointment_date', $selectedDate)->where('status', 'Claimed');
                        })->get();
        $pendingRequests = Appointment::where('status', 'Pending')
                        ->where('payment_status', 'Requesting')
                        ->get();
        $processedDocs = Appointment::whereNotIn('status', ['Claimed', 'Ready to Claim'])
            ->where('payment_status', 'Approved')
            ->get();
        $requests = Appointment::where('status', 'Pending')
            ->where('payment_status', 'Requesting')
            ->get();
        $filteredRequests = [];
        foreach ($requests as $request) {
            $notification = DB::table('notifications')
                ->where('data->notif_type', 'Re-upload Requirements')
                ->where('data->app_id', $request->id)
                ->where('data->uploaded', 0)
                ->first();

            if (!$notification) {
                $filteredRequests[] = $request;
            }
        }
        return view('admin-dashboard.request', compact('ready', 'claimed', 'pendingRequests', 'processedDocs','thisDay', 'filteredRequests'));
    }

    //review ===========================Returning all request ===========================================================
    public function viewAllRequest(Request $request){
        $bookings = Booking::with('user', 'appointment')
                            ->where('resched', 0)
                            ->whereDoesntHave('appointment', function ($query) {
                                $query->where('status', 'claimed');
                            })->get();
        return view('admin-dashboard.request-all', compact('bookings'));
    }

    public function viewAllResched(Request $request){
        $bookings = Booking::with('user', 'appointment')
                            ->where('resched', 1)
                            ->whereDoesntHave('appointment', function ($query) {
                                $query->where('status', 'claimed');
                            })->get();
        return view('admin-dashboard.request-resched', compact('bookings'));
    }

    public function updateRemark(Request $request){
        $app_id = $request->input('app_id');
        $appointment = Appointment::find($app_id);
        $doc = $request->input('doc');
        $resched = $request->input('resched_check');
        $title = $request->title;
        $remarks = $request->input('remarks');

        $bookings = Booking::where('appointment_id', $app_id)->first();
        if($resched == null){
            $bookings->resched = 0;
        }else{
            $bookings->resched = $resched;
        }
        $bookings->save();

        if($title === "Re-upload Requirements Request:"){
            $notif_type = "Re-upload Requirements";
            $notification = new ReuploadRequirementsNotification($remarks, $app_id, $notif_type, 0);
            $appointment->user->notify($notification);
        }else{
            $notif_type = $request->input('notif_type');
            $notification = new AppRemarksUpdate($remarks, $app_id, $notif_type, $title, $doc, $resched);
            $appointment->user->notify($notification);
        }
        
        return redirect()->back();
    }

    public function viewSettings(Request $request){
        $staffs = RegistrarStaff::all();
        $user = User::where('role', 1)->first();
        $admin_email = $user->email;
        $admin_cell_no = $user->cell_no;
        $admin_id = $user->id;
        $web_image = WebsiteImageContent::all();

        $admins = User::where('role', 2)
                        ->orWhere('role', 3)
                        ->orderBy('created_at', 'ASC')
                        ->get();

        return view('admin-dashboard.settings', compact('staffs', 'admin_email', 'admin_cell_no', 'admin_id', 'admins', 'web_image'));
    }

    public function viewUserRegistration(Request $request){
        $pending = User::where('account_status', 'Pending')
                        ->where('role', 0)
                        ->get();
        $approved = User::where('account_status', 'Approved')
                        ->where('role', 0)
                        ->get();
        $rejected = User::where('account_status', 'Rejected')
                        ->where('role', 0)
                        ->get();
        return view('admin-dashboard.registration-approval', compact('pending', 'approved', 'rejected'));
    }

    public function approveUserRegistration(Request $request, $id){
        $user = User::find($id);
        $user->account_status = "Approved";
        $user->account_approved = now();
        $user->account_rejected = null;
        $user->save();
        return back();
    }public function rejectUserRegistration(Request $request, $id){
        $user = User::find($id);
        $user->account_status = "Rejected";
        $user->account_approved = null;
        $user->account_rejected = now();
        $user->save();
        return back();
    }public function pendingUserRegistration(Request $request, $id){
        $user = User::find($id);
        $user->account_status = "Pending";
        $user->account_approved = null;
        $user->account_rejected = null;
        $user->save();
        return back();
    }

    public function pendingUserCount(){
        $count = User::where('account_status', 'Pending')
                        ->where('role', 0)
                        ->count();
    
        return response()->json(['count' => $count]);
    }

    public function viewInfoRequest($id){
        $info = Appointment::find($id);
        $fullName = $info->user->lastName . ', ' . $info->user->firstName;
        if ($info->user->middleName) {
            $fullName .= ' ' . $info->user->middleName;
        }if ($info->user->suffix) {
            $fullName .= ' ' . $info->user->suffix;
        }
        $req_date = Carbon::parse($info->created_at)->format('F d, Y g A');

        $requirements = Requirement::where('booking_id', $id)->get(['file_name', 'file_path']);

        $fileNames = [];
        foreach ($requirements as $requirement) {
            $fileName = basename($requirement->file_name);
            $filePath = $requirement->file_path;
            $fileNames[] = [
                'file_name' => $fileName,
                'file_path' => $filePath,
            ];
        }

        $payment = Payment::where('appointment_id', $id)->first();
        if(!$payment){
            $payment = new Payment();
            $payment->proof_of_payment = null;
            $payment->reference_number = null;
            $payment->or_file_path = null;
        }
    
        return response()->json([
            'fullName' => $fullName,
            'doc_name' => $info->form->name,
            'req_date' => $req_date,
            'req_purpose' => $info->app_purpose,
            'req_copies' => $info->num_copies,
            'acad_year' => $info->acad_year,
            'requirements' => $fileNames,

            'address' => $info->user->address,
            'school_id' => $info->user->school_id,
            'cell_no' => $info->user->cell_no,
            'civil_status' => $info->user->civil_status,
            'email' => $info->user->email,
            'birthdate' => Carbon::parse($info->user->birthdate)->format('F j, Y'),
            'status' => $info->user->status,
            'gender' => $info->user->gender,
            'course' => $info->user->course,
            'acadYear' => $info->user->acadYear,
            'gradYear' => $info->user->gradYear,

            'booking_number' => $info->booking_number,
            'a_transfer' => $info->a_transfer,
            'a_transfer_school' => $info->a_transfer_school,
            'b_transfer' => $info->b_transfer,
            'b_transfer_school' => $info->b_transfer_school,

            'payment_method' => $info->payment_method,
            'proof_of_payment' => $payment->proof_of_payment,
            'reference_number' => $payment->reference_number,
            'or_file_path' => $payment->or_file_path,
            'requirements' => $fileNames
        ]);
    }

    public function confirmPayment(Request $request){
        $id = $request->request_id;
        $remarks = $request->input('remarks');
        $no_payment = $request->input('no_payment');
        $requester = Appointment::find($id);

        if($no_payment == 1){
            $requester->payment_status = "Approved";
            $requester->date_approved = now();
            $requester->status = "Confirmed Payment";
            $requester->save(); 
        }else{
            $payment = new Payment();
            $payment->appointment_id = $id;
            $payment->confirmed_payment_remarks = $remarks;
            $payment->save();
            $requester->payment_status = "Pending";
            $requester->status = "Confirmed Payment";
            $requester->save(); 
            $notification = new ConfirmedPaymentNotification($remarks, $id, $payment->payment_id, "Confirm Payment");
            $requester->user->notify($notification);
        }
    }

    public function paymentsInfo($id){
        $payment = Payment::find($id);
    
        return response()->json([
            'confirmed_payment_remarks' => $payment->confirmed_payment_remarks,
            'reference_number' => $payment->reference_number,
            'proof_of_payment' => $payment->proof_of_payment
        ]);
    }
}
