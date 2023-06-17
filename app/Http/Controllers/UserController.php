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
use App\Models\Requirement;
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

            $notifications = User::find($user_id)
                  ->notifications()
                  ->orderBy('created_at', 'desc')
                  ->take(10)->get();
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

      public function notifDelete($id, $notif_type){
            $bookings = Booking::find($id);
            $user = $bookings->user;
            $user->notifications()
                  ->where('data->app_id', $id)
                  ->where('data->notif_type', $notif_type)
                  ->delete();
            return back();
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

      public function reuploadRequirements(Request $request){
            $appointment = Appointment::find($request->request_id);
            $old_requirements = Requirement::where('booking_id', $request->request_id)->get();
            foreach ($old_requirements as $requirement) {
                  $filePath = public_path($requirement->file_path);
                  if (file_exists($filePath)) {
                      unlink($filePath);
                  }
                  $requirement->delete();
            }
            if ($request->hasFile('requirements')) {
                  $requirements = $request->requirements;
                  foreach ($requirements as $fileName) {
                        $timestamp_req = time();
                        $fileName_req = $appointment->user->id . '_' . $timestamp_req . '_' . $fileName->getClientOriginalName();
                        $fileName_orig = $fileName->getClientOriginalName();
                        $requirementPath = $fileName->move(public_path('images/requirements'), $fileName_req);
                        $req = new Requirement();
                        $req->booking_id = $appointment->id;
                        $req->file_path = 'images/requirements/'.$fileName_req;
                        $req->file_name = $fileName_orig;
                        $req->save();
                  }
            }
            $existingNotification = $appointment->user->notifications()
                  ->where('data->notif_type', "Re-upload Requirements")
                  ->where('data->app_id', $request->request_id)
                  ->first();
            if ($existingNotification) {
                  $data = $existingNotification->data;
                  $data['uploaded'] = 1;
                  $existingNotification->data = $data;
                  $existingNotification->save();
            }
            return back();
      }
}
