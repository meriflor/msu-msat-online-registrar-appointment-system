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
use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;


class CustomAuthController extends Controller
{
 //------------------------------------// Registration & Log-in //--------------------------------------------------------// 
      public function registerUser(Request $request){
            $request->validate([
                  'firstName'=>'required',
                  'lastName'=>'required',
                  'middleName'=>'',
                  'suffix'=>'',
                  'address'=>'required',
                  'school_id'=>'required|unique:users',
                  'cell_no'=>'required|unique:users',
                  'civil_status'=>'required',
                  'email'=>'required|email|unique:users',
                  'birthdate'=>'required',
                  'gender'=>'required',
                  'status'=>'required',
                  'course'=>'required',
                  'acadYear'=>'',
                  'gradYear'=>'',
                  'password'=>'required|min:8',
            ]);
            //Inserting data from the user inputed
            $user = new User();
            $user -> firstName =ucfirst($request->firstName);
            $user -> lastName =ucfirst($request->lastName);
            $user -> middleName =ucfirst($request->middleName);
            $user -> suffix =ucfirst($request->suffix);
            $user -> address = $request->address;
            $user -> school_id = $request ->school_id;
            $user -> cell_no = $request ->cell_no;
            $user -> civil_status = $request->input('civil_status');
            $user -> email = $request->email;
            $user->birthdate = $request->input('birthdate');
            $user->status = $request->input('status');
            if ($user->status === "High School Graduate (Before K-12)" || $user->status === "Senior High School Graduate" || $user->status === "College Graduate" || $user->status === "Master's Degree Graduate") {
                  $user->acadYear = null;
                  // $user->gradYear = $request->input('grad_year');
                  $gradYear = $request->input('grad_year');
                  if($gradYear === "other"){
                        $user->gradYear = $request->input('input_other_grad_year');
                  }else{
                        $user->gradYear = $gradYear;
                  }
            } else {
                  // $user->acadYear = $request->input('acad_year');
                  $acadYear = $request->input('acad_year');
                  $user->gradYear = null;
                  if($acadYear === "other"){
                        $user->acadYear = $request->input('input_other_acad_year');
                  }else{
                        $user->acadYear = $acadYear;
                  }
            }
            $user->gender = $request->input('gender');
            // $user->course = $request->input('course');
            $courseInput = $request->input('course');
            if($courseInput == "other"){
                  $user->course = $request->input('course_name');
            }else{
                  $user->course = $courseInput ;
            }
            $user -> password = Hash::make($request->password);
            $user -> account_status = "Pending";
            $res = $user -> save();

            if($res){
                  return back()-> with ('success','You have registered successfully');
            }else{
                  return back()-> with('fail','Something wrong');
            }

      }


      public function loginUser(Request $request)
      {
            $request->validate([
                  'email' => 'required|email',
                  'password' => 'required|min:8',
            ]);

            $user = User::where('email', '=', $request->email)->first();

            if ($user) {
                  if (Hash::check($request->password, $user->password)) {
                        $request->session()->put('loginId', $user->id);

                        if ($user->role == 1) {
                              return redirect()->route('dashboard-admin');
                        }else if($user->role == 2){
                              return redirect()->route('subadmin-dashboard');
                        }else if($user->role == 3){
                              return redirect()->route('subadmin-cashier-dashboard');
                        }else {
                              return redirect()->route('user-dashboard');
                        }
                  } else {
                        return back()->with('fail', 'Email and password do not match.');
                  }
            } else {
                  return back()->with('fail', 'This email is not registered.');
            }
      }

      public function logout(){
            if (Session::has('loginId')){
                  Session::pull('loginId');
                  return redirect('/');
            }
      }

 //------------------------------------// Setting up Booking Appointment //--------------------------------------------------------// 
      public function bookAppointment(Request $request){
            $user_id = session('loginId');
            $form = Form::find($request->form_id);

            if (!$form) {
            abort(404);
            }   

            $request->validate([
                  'app_purpose' => 'required',
                  // 'appointment_date' => 'required',
                  'a_transfer' => 'required',
                  'b_transfer' => 'required'
            ]);

            $appointment = new Appointment();
            $appointment->app_purpose = $request->app_purpose;
            $appointment->acad_year = $request ->acad_year;

            $appointment->a_transfer = $request ->a_transfer;
            $appointment->a_transfer_school = $request ->a_transfer_school;
            $appointment->b_transfer = $request ->b_transfer;
            $appointment->b_transfer_school = $request ->b_transfer_school;

            $appointment->status = "Pending";
            $appointment->num_copies = $request ->num_copies;

            $appointment->user_id = $user_id;
            $appointment->form_id = $form->id;
            $appointment->payment_status = "Requesting";

            if ($appointment->save()) {
                  $year = date('Y');
                  $appointmentId = str_pad($appointment->id, 4, '0', STR_PAD_LEFT);
                  $bookingNumber = sprintf("%s-%s", $year,$appointmentId);
                  $appointment->booking_number = $bookingNumber;
                  $appointment->save();

                  $booking = new Booking();
                  $booking->user_id = $user_id;
                  $booking->appointment_id = $appointment->id;
                  $booking->resched = 0;
                  $booking->save();
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
                  return response()->json(['success' => true, 'message' => 'Appointment booked successfully.']);
            } else {
                  return response()->json(['success' => false, 'message' => 'Appointment booking failed.']);
            }
      }

//-------------------------------// Retrive All Bookings and Displaying//-------------------------------//

      public function updateProfile(Request $request){
            $user_id = session('loginId');

            $user = User::find($user_id);
            if (!$user) {
                  abort(404);
            }

            $user->firstName = $request->input('editFirstName');
            $user->lastName = $request->input('editLastName');
            $user->middleName = $request->input('editMiddleName');
            $user->suffix = $request->input('editSuffix');
            $user->address = $request->input('editAddress');
            $user->school_id = $request->input('editSchoolID');
            $user->cell_no = $request->input('editCpNo');
            $user->civil_status = $request->input('editCivilStatus');
            $user->email = $request->input('editEmail');
            $user->birthdate = $request->input('editBirthdate');
            $user->status = $request->input('editStatus');
            if ($user->status === "High School Graduate (Before K-12)" || $user->status === "Senior High School Graduate" || $user->status === "College Graduate" || $user->status === "Master's Degree Graduate") {
                  $user->acadYear = null;
                  $user->gradYear = $request->input('editGradYear');
            } else {
                  $user->acadYear = $request->input('editAcadYear');
                  $user->gradYear = null;
            }
            $user->gender = $request->input('editGender');
            $courseInput = $request->input('editCourse');
            if($courseInput == "other"||$courseInput==null){
                  $user->course = $request->input('course_name');
            }else{
                  $user->course = $courseInput ;
            }
            if($user->account_status == "Rejected"){
                  $user->account_status = "Pending";
                  $user->account_approved = null;
                  $user->account_rejected = null;
            }

            $user->save();

            return redirect('/edit-profile')->with('success', 'User information updated successfully.');
      }

      public function cancel_appointment(Request $request, $id)
      {
            $booking = Booking::where('appointment_id', $id)->first();
            $appointment = Appointment::find($id);
            if($appointment && $appointment->status === "Pending"){
                  if(!$booking){
                        $appointment->delete();
                  }else{
                        $booking->delete();
                        $appointment->delete();
                  }
                  return response()->json([
                        'success' => true,
                        'message' => 'Appointment has been cancelled successfully.',
                  ]);
            }
           
            return response()->json([
                'success' => false,
                'message' => 'Unable to cancel appointment.',
            ]);
      }
}
