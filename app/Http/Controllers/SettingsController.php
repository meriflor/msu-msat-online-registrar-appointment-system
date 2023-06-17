<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\RegistrarStaff;
use App\Models\User;
use Carbon\Carbon;

class SettingsController extends Controller
{
    public function registrarStaffStore(Request $request){
        $staffs = new RegistrarStaff();
        $staffs->full_name = $request->add_staff_name;
        $staffs->position = $request->add_staff_position;

        if($request->hasFile('add_staff_img')){
            $profile_image = $request->file('add_staff_img');
            if($profile_image->isValid()){
                $timestamp = time();
                $fileName = $timestamp . '_' . $profile_image->getClientOriginalName();
                $pop_path = $profile_image->move(public_path('images/registrar-staff'), $fileName);
                $staffs->profile_image = 'images/registrar-staff/'.$fileName;
            }else {
                return response()->json(['error' => 'Invalid file'], 400);
            }
        }else {
            return response()->json(['error' => 'You have not uploaded an image.'], 400);
        }
        $staffs->save();
        return redirect('/dashboard-admin/settings');
    }

    public function registrarStaffUpdate(Request $request, $id){
        $staffs = RegistrarStaff::find($id);
        $staffs->full_name = $request->update_staff_name;
        $staffs->position = $request->update_staff_position;
        if($request->hasFile('update_staff_img')){
            $profile_image = $request->file('update_staff_img');
            if($profile_image->isValid()){
                $timestamp = time();
                $fileName = $timestamp . '_' . $profile_image->getClientOriginalName();
                $pop_path = $profile_image->move(public_path('images/registrar-staff'), $fileName);
                $staffs->profile_image = 'images/registrar-staff/'.$fileName;
            }else {
                return response()->json(['error' => 'Invalid file'], 400);
            }
        }
        $staffs->save();
        return redirect('/dashboard-admin/settings');
    }

    public function registrarStaffDelete(Request $request, $id){
        $staffs = RegistrarStaff::find($id);
        $imagePath = public_path($staffs->profile_image);
        if (file_exists($imagePath)) {
            Storage::delete($staffs->profile_image);
        }else{
            return response()->json(['success' => false, 'message' => 'Failed successfully.']);
        }
        $staffs->delete();
        return redirect('/dashboard-admin/settings');
    }

    public function adminContactUpdate(Request $request, $id){
        $admin = User::find($id);
        $admin->email = $request->update_admin_email;
        $admin->cell_no = $request->update_admin_cp_no;
        $admin->save();
        return redirect('/dashboard-admin/settings');
    }

    public function adminAccountAdd(Request $request){
        $request->validate([
            'add_admin_email' => 'required|unique:users,email',
            'add_admin_pass' => 'required|min:8',
        ], [
            'add_admin_email.required' => 'The email field is required.',
            'add_admin_email.unique' => 'The email is already taken.',
            'add_admin_pass.required' => 'The password field is required.',
            'add_admin_pass.min' => 'The password must be at least 8 characters.',
        ]);
        $admin = new User();
        $admin->firstName = "Admin";
        $admin->lastName = "Admin";
        $admin->address = "Admin";
        $admin->school_id = Carbon::now()->format('YHis');
        $admin->cell_no = "admin-" . now();
        $admin->email = $request->add_admin_email;
        $admin->password = Hash::make($request->add_admin_pass);
        $admin->account_status = "Approved";
        $admin->account_approved = null;
        $admin->account_rejected = null;
        $admin->role = $request->add_admin_role;
        $admin->save();
        return back();
    }
    
    public function adminAccountUpdate(Request $request, $id){
        $admin = User::find($id);
        $request->validate([
            'edit_admin_email' => [
                'sometimes',
                'nullable',
                Rule::unique('users', 'email')->ignore($admin->email, 'email')
            ],
        ], [
            'edit_admin_email.unique' => 'The email is already taken.',
        ]);
        if($request->edit_admin_email){
            $admin->email = $request->edit_admin_email;
        }if($request->edit_admin_pass){
            $admin->password = Hash::make($request->edit_admin_pass);
        }if($request->edit_admin_role){
            $admin->role = $request->edit_admin_role;
        }
        $admin->save();
        return back();
    }

    public function adminAccountDelete(Request $request, $id){
        $admin = User::find($id);
        $admin->delete();
        return back();
    }
}
