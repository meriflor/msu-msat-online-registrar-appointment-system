<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
class UserController extends Controller
{
    public function viewUser(){
        $user = array();
        $appointments = Appointment::all();
        $forms = Form::all();

        if (Session::has('loginId')) {
        $user = User::where('id','=',Session::get('loginId'))->first();
        $user_id = session('loginId');
        $appointments = Appointment::where('user_id', $user_id)
              ->orderBy('created_at', 'desc')
              ->with(['user' => function ($query) {
                    $query->select('id', 'firstName','lastName','middleName','email','suffix');
              }, 'form' => function ($query) {
                    $query->select('id', 'name','fee');
              }])
              ->get();
        }

        $firstName = $user ? $user->firstName : null;
        $lastName = $user ? $user->lastName : null;
        $middleName = $user ? $user->middleName : null;
        $suffix = $user ? $user->suffix : null;
        $address = $user ? $user->address : null;
        $school_id = $user ? $user->school_id : null;
        $cell_no = $user ? $user->cell_no : null;
        $civil_status = $user ? $user->civil_status : null;
        $email = $user ? $user->email : null;
        $birthdate = $user ? $user->birthdate : null;
        $status = $user ? $user->status : null;
        $acadYear = $user ? $user->acadYear : null;
        $gradYear = $user ? $user->gradYear : null;
        $gender = $user ? $user->gender : null;
        $course = $user ? $user->course : null;

        $user_id = session('loginId');
        $pending = Appointment::whereNotIn('status', ['Claimed'])
                                ->where('user_id', $user_id)->get();
        
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
        $bookings = Booking::all();
        $pending_appointments = Appointment::where('appointment_date', '!=', null)
                              ->where('status', 'Ready to Claim')
                              ->where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();

        return view('appointment.content.dashboard', compact('firstName','lastName','middleName','suffix','address','school_id','cell_no','civil_status','email','birthdate','gender','status', 'acadYear', 'gradYear', 'course',
        'forms',
        'appointments', 'pending', 'announcements', 'bookings', 'user', 'pending_appointments'
        ));
    }

    public function viewUserAppointments(){
        $user = array();
        $appointments = Appointment::all();
        $forms = Form::all();

        if (Session::has('loginId')) {
        $user = User::where('id','=',Session::get('loginId'))->first();
        $user_id = session('loginId');
            $appointments = Appointment::with('user', 'form')
                  ->where('user_id', $user_id)
                  ->orderBy('created_at', 'desc')
                  ->get();
            }
        $firstName = $user ? $user->firstName : null;
        $lastName = $user ? $user->lastName : null;
        $middleName = $user ? $user->middleName : null;
        $suffix = $user ? $user->suffix : null;
        $address = $user ? $user->address : null;
        $school_id = $user ? $user->school_id : null;
        $cell_no = $user ? $user->cell_no : null;
        $civil_status = $user ? $user->civil_status : null;
        $email = $user ? $user->email : null;
        $birthdate = $user ? $user->birthdate : null;
        $status = $user ? $user->status : null;
        $acadYear = $user ? $user->acadYear : null;
        $gradYear = $user ? $user->gradYear : null;
        $gender = $user ? $user->gender : null;
        $course = $user ? $user->course : null;

        $user_id = session('loginId');
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
        $pending_appointments = Appointment::where('appointment_date', '!=', null)
                              ->where('status', 'Ready to Claim')
                              ->where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();
            $pending = Appointment::whereNotIn('status', ['Claimed'])
                                ->where('user_id', $user_id)->get();

            $bookings = Booking::all();
        return view('appointment.content.appointment-records', compact('firstName','lastName','middleName','suffix','address','school_id','cell_no','civil_status','email','birthdate','gender','status', 'acadYear', 'gradYear', 'course',
        'forms', 'appointments', 'pending_appointments', 'announcements', 'bookings', 'pending'
        ));
    }

    public function viewUserEditProfile(){
        $user = array();
        $courses = Course::all(); 
        $appointments = Appointment::all();
        $forms = Form::all();

        if (Session::has('loginId')) {
        $user = User::where('id','=',Session::get('loginId'))->first();
        $user_id = session('loginId');
        $appointments = Appointment::where('user_id', $user_id)
              ->orderBy('created_at', 'desc')
              ->with(['user' => function ($query) {
                    $query->select('id', 'firstName','lastName','middleName','email','suffix');
              }, 'form' => function ($query) {
                    $query->select('id', 'name','fee');
              }])
              ->get();
        }

        $firstName = $user ? $user->firstName : null;
        $lastName = $user ? $user->lastName : null;
        $middleName = $user ? $user->middleName : null;
        $suffix = $user ? $user->suffix : null;
        $address = $user ? $user->address : null;
        $school_id = $user ? $user->school_id : null;
        $cell_no = $user ? $user->cell_no : null;
        $civil_status = $user ? $user->civil_status : null;
        $email = $user ? $user->email : null;
        $birthdate = $user ? $user->birthdate : null;
        $status = $user ? $user->status : null;
        $acadYear = $user ? $user->acadYear : null;
        $gradYear = $user ? $user->gradYear : null;
        $gender = $user ? $user->gender : null;
        $course = $user ? $user->course : null;

        $user_id = session('loginId');
        $pending = Appointment::whereNotIn('status', ['Claimed'])
                                ->where('user_id', $user_id)->get();
        
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
        $pending_appointments = Appointment::where('appointment_date', '!=', null)
                              ->where('status', 'Ready to Claim')
                              ->where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();

        $bookings = Booking::all();
        return view('appointment.content.edit-profile', compact('firstName','lastName','middleName','suffix','address','school_id','cell_no','civil_status','email','birthdate','gender','status', 'acadYear', 'gradYear', 'course',
        'forms','bookings',
        'appointments', 'pending', 'announcements','courses' , 'pending_appointments'
        ));
    }
    
    public function viewUserSettings(){
        $user = array();
        $appointments = Appointment::all();
        $forms = Form::all();

        if (Session::has('loginId')) {
        $user = User::where('id','=',Session::get('loginId'))->first();
        $user_id = session('loginId');
        $appointments = Appointment::where('user_id', $user_id)
              ->orderBy('created_at', 'desc')
              ->with(['user' => function ($query) {
                    $query->select('id', 'firstName','lastName','middleName','email','suffix');
              }, 'form' => function ($query) {
                    $query->select('id', 'name','fee');
              }])
              ->get();
        }

        $firstName = $user ? $user->firstName : null;
        $lastName = $user ? $user->lastName : null;
        $middleName = $user ? $user->middleName : null;
        $suffix = $user ? $user->suffix : null;
        $address = $user ? $user->address : null;
        $school_id = $user ? $user->school_id : null;
        $cell_no = $user ? $user->cell_no : null;
        $civil_status = $user ? $user->civil_status : null;
        $email = $user ? $user->email : null;
        $birthdate = $user ? $user->birthdate : null;
        $status = $user ? $user->status : null;
        $acadYear = $user ? $user->acadYear : null;
        $gradYear = $user ? $user->gradYear : null;
        $gender = $user ? $user->gender : null;
        $course = $user ? $user->course : null;

        $user_id = session('loginId');
        $pending = Appointment::whereNotIn('status', ['Claimed'])
                                ->where('user_id', $user_id)->get();
        
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
        $pending_appointments = Appointment::where('appointment_date', '!=', null)
                              ->where('status', 'Ready to Claim')
                              ->where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();

        $bookings = Booking::all();
        return view('appointment.content.settings', compact('firstName','lastName','middleName','suffix','address','school_id','cell_no','civil_status','email','birthdate','gender','status', 'acadYear', 'gradYear', 'course',
        'forms', 'bookings',
        'appointments', 'pending', 'announcements', 'pending_appointments'
        ));
    }

    public function viewUserNotification(){
        $user = array();
        $appointments = Appointment::all();
        $forms = Form::all();

        if (Session::has('loginId')) {
        $user = User::where('id','=',Session::get('loginId'))->first();
        $user_id = session('loginId');
        $appointments = Appointment::where('user_id', $user_id)
              ->orderBy('created_at', 'desc')
              ->with(['user' => function ($query) {
                    $query->select('id', 'firstName','lastName','middleName','email','suffix');
              }, 'form' => function ($query) {
                    $query->select('id', 'name','fee');
              }])
              ->get();
        }

        $firstName = $user ? $user->firstName : null;
        $lastName = $user ? $user->lastName : null;
        $middleName = $user ? $user->middleName : null;
        $suffix = $user ? $user->suffix : null;
        $address = $user ? $user->address : null;
        $school_id = $user ? $user->school_id : null;
        $cell_no = $user ? $user->cell_no : null;
        $civil_status = $user ? $user->civil_status : null;
        $email = $user ? $user->email : null;
        $birthdate = $user ? $user->birthdate : null;
        $status = $user ? $user->status : null;
        $acadYear = $user ? $user->acadYear : null;
        $gradYear = $user ? $user->gradYear : null;
        $gender = $user ? $user->gender : null;
        $course = $user ? $user->course : null;

        $user_id = session('loginId');
        $pending = Appointment::whereNotIn('status', ['Claimed'])
                                ->where('user_id', $user_id)->get();
        
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();

            //notifications
            $notifications = User::find($user_id)
                  ->notifications()
                  ->orderBy('created_at', 'desc')
                  ->take(10)->get();
            // Mark all notifications as read
            User::find($user_id)->unreadNotifications->markAsRead();

            $bookings = Booking::all();
            $payments = Payment::all();
            $pending_appointments = Appointment::where('appointment_date', '!=', null)
                              ->where('status', 'Ready to Claim')
                              ->where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();
            $setting_appointment = Appointment::
                              where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();

        return view('appointment.content.notification', compact('firstName','lastName','middleName','suffix','address','school_id','cell_no','civil_status','email','birthdate','gender','status', 'acadYear', 'gradYear', 'course',
        'forms', 'bookings',
        'appointments', 'pending', 'announcements', 'notifications', 'payments', 'pending_appointments', 'setting_appointment'
        ));
    }

//     review request records
      public function viewRequestRecords(){
            $user = array();
            $appointments = Appointment::all();
            $forms = Form::all();

            if (Session::has('loginId')) {
                  $user = User::where('id','=',Session::get('loginId'))->first();
                  $user_id = session('loginId');
                  $appointments = Appointment::with('user', 'form')
                        ->where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->get();
            }
            $firstName = $user ? $user->firstName : null;
            $lastName = $user ? $user->lastName : null;
            $middleName = $user ? $user->middleName : null;
            $suffix = $user ? $user->suffix : null;
            $address = $user ? $user->address : null;
            $school_id = $user ? $user->school_id : null;
            $cell_no = $user ? $user->cell_no : null;
            $civil_status = $user ? $user->civil_status : null;
            $email = $user ? $user->email : null;
            $birthdate = $user ? $user->birthdate : null;
            $status = $user ? $user->status : null;
            $acadYear = $user ? $user->acadYear : null;
            $gradYear = $user ? $user->gradYear : null;
            $gender = $user ? $user->gender : null;
            $course = $user ? $user->course : null;

            $user_id = session('loginId');
            
            $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
            $bookings = Booking::all();
            $pending = Appointment::whereNotIn('status', ['Claimed'])
                                    ->where('user_id', $user_id)
                                    ->orderBy('created_at', 'asc')
                                    ->get();
            $claimed = Appointment::where('status', 'Claimed')
                                    ->where('user_id', $user_id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
            $pending_appointments = Appointment::where('appointment_date', '!=', null)
                              ->where('status', 'Ready to Claim')
                              ->where('user_id', $user_id)
                              ->orderBy('created_at', 'asc')
                              ->get();

            return view('appointment.content.request-records', compact('firstName','lastName','middleName','suffix','address','school_id','cell_no','civil_status','email','birthdate','gender','status', 'acadYear', 'gradYear', 'course',
            'forms', 'bookings', 'appointments', 'pending', 'announcements', 'claimed', 'pending_appointments'
            ));
      }

      public function reschedAppointment(Request $request){
            $app_id = $request->input('re_app_id');
            $appointment = Appointment::find($app_id);

            // dd($request->input('re_app_date_input'));
            $appointment->appointment_date = $request->input('re_app_date_input');
            $appointment->remarks = null;
            $appointment->save();

            $bookings = Booking::where('appointment_id', $app_id)->first();
            $bookings->resched = 0;
            $bookings->save();

            $existingNotification = $appointment->user->notifications()
                  ->where('data->notif_type', "remarks")
                  ->where('data->app_id', $app_id)
                  ->first();
            if($existingNotification){
                  $existingNotification->delete();
            }
            return redirect()->back();
      }

      public function notifDelete($id, $notif_type){
            $bookings = Booking::find($id);
            $user = $bookings->user;
            // delete a specific notification by ID (in case code)
            $user->notifications()
                  ->where('data->app_id', $id)
                  ->where('data->notif_type', $notif_type)
                  ->delete();
            return back();
            // // delete all the notifications for the user
            // $user->notifications()->delete();
      }
      
      public function unreadNotif(){
            $user = User::find(session('loginId'));
            $unreadNotifications = $user->notifications()->whereNull('read_at')->count();
            return response()->json(['count' => $unreadNotifications]);
      }

      public function uploadPayment(Request $request){
            $payment_id = $request->payment_id;
            $request_id = $request->request_id;

            $request_document = Appointment::find($request_id);
            $request_document->payment_method = $request->payment_method;
            $request_document->save();

            $payment = Payment::find($payment_id);
            $payment->reference_number = $request->reference_number;
            if ($request->hasFile('proof_of_payment')) {
                  $proof_of_payment = $request->file('proof_of_payment');
                  if ($proof_of_payment->isValid()) {
                        $timestamp = time();
                        $fileName = $timestamp . '_' . $proof_of_payment->getClientOriginalName();
                        $pop_path = $proof_of_payment->move(public_path('images/proof-of-payment'), $fileName);
                        $payment->proof_of_payment = 'images/proof-of-payment/'.$fileName;
                  } else {
                        return response()->json(['error' => 'Invalid file'], 400);
                  }
            } else {
                  $payment->proof_of_payment = null;
            }
            $payment->save();
            return response()->json(['message' => 'Payment uploaded successfully']);
      }
      
      public function setAppointment(Request $request){
            $appointment = Appointment::find($request->request_id);
            $appointment->appointment_date = Carbon::parse($request->appointment_date)->format('Y-m-d');
            $appointment->save();
            return back();
      }
}
