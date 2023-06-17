<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\Course;
use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class formController extends Controller
{

      public function createForm(Request $request){
            $request ->validate([
                  'name' => 'required',
                  'form_requirements'=>'required',
                  'form_process'=>'required',
                  'fee'=>'required',
                  'form_avail'=>'required',
                  'form_who_avail'=>'required',
                  'form_max_time'=>'required',
            ]);
      
            $form = new Form();
            $form -> name = $request -> name;
            $form -> form_requirements = $request -> form_requirements;
            $form -> form_process = $request -> form_process;
            $form -> form_avail = $request -> form_avail;
            $form -> form_who_avail = $request -> form_who_avail;
            $form -> form_max_time = $request -> form_max_time;

            $form -> fee = $request -> fee;
            
            if($request->fee_type === "None" || $request->fee_type === "none" || $request->fee_type === null){
                  $form->fee_type = "None";
            }else{
                  $form->fee_type = $request->fee_type;
            }if($request->pages == 0){
                  $form->pages = 1;
            }else{
                  $form->pages = $request->pages;
            }

            if ($request->has('ask_acad_year')) {
                  // Checkbox is checked
                  $form->acad_year = 1;
            }
            if ($request->has('ask_requirements')) {
                  // Checkbox is checked
                  $form->requirements = 1;
            }

            $form = $form -> save();
            if($form){
                  return back()-> with ('success','Form created successfully');
            }else{
                  return back()-> with('fail','Something wrong');
            }
      
      }
  

      public function viewForm(){
            $forms = Form::all();
            $courses = Course::all();
            return view('admin-dashboard/forms', compact('forms','courses'));
      }

      public function viewOneForm($id){
            $forms = Form::where('id', $id)->findOrFail($id);

            return response()->json([
                  'name' => $forms->name,
                  'form_requirements' => $forms->form_requirements,
                  'form_who_avail' => $forms->form_who_avail,
                  'form_process' => $forms->form_process,
                  'fee' => $forms->fee,
                  'form_avail' => $forms->form_avail,
                  'form_max_time' => $forms->form_max_time,
                  'fee_type' => $forms->fee_type,
                  'pages' => $forms->pages,
                  'acad_year' => $forms->acad_year,
                  'requirements' => $forms->requirements
            ]);
      }

      public function editForm(Request $request){
            $forms = Form::find($request->formID);
            $forms->name = $request->editFormName;
            $forms->form_requirements = $request->editReq;
            $forms->form_process = $request->editProcessingTime;
            $forms->fee = $request->editDocFee;
            $forms->form_avail = $request->editAvailability;
            $forms->form_who_avail = $request->editAvailService;
            $forms->form_max_time = $request->editMaxTimeClaim;
            
            if($request->editDocFeeType === "None" || $request->editDocFeeType === "none" || $request->editDocFeeType === null){
                  $forms->fee_type = "None";
            }else{
                  $forms->fee_type = $request->editDocFeeType;
            }if($request->editDocPages == 0){
                  $forms->pages = 1;
            }else{
                  $forms->pages = $request->editDocPages;
            }

            $forms->acad_year = $request->editAcadYear;
            $forms->requirements = $request->editRequirements;
            
            $forms->save();

            return response()->json(['success' => true, 'message' => 'The Forms is successfully updated.']);
      }

      public function delete(Request $request, $id){
            $forms = Form::find($id);
            
            if($forms){
                  $forms->delete();
                  return response()->json(['success' => true, 'message' => 'You have deleted successfully']);
            }return response()->json(['success' => false, 'message' => 'Were dead.']);
      }
}
