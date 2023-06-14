<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AppointmentSlot;
use App\Models\Appointment;
use App\Models\Form;
use App\Models\Booking;

class AppointmentSlotController extends Controller
{
    public function store(Request $request){
        $appointmentSlot = new AppointmentSlot();
        $appointmentSlot->slot_date = $request->slot_date;
        $appointmentSlot->available_slots = $request->available_slots;
        $appointmentSlot->is_disabled = $request->disabled;
        
        $appointmentSlot->save();
        return back()->with('success', 'Appointment slot created successfully.');
    }


    //review ========================delete appointment slot==============================
    public function destroy(Request $request, $id)
    {
        $appointmentSlot = AppointmentSlot::find($id);
        $slot_date = $appointmentSlot->slot_date;
        $appDate = Carbon::parse($slot_date)->format('F d, Y');
        $appointments = Appointment::where('appointment_date', $appDate)->get();

        foreach ($appointments as $appointment) {
            $bookings = Booking::where('appointment_id', $appointment->id)->delete();
            $appointment->delete();
        }

        $appointmentSlot->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appointment slot deleted successfully.',
        ]);
    }

    //review ============================ Rendering Calendar,, ==================================
    
    public function events(Request $request){
        $appointmentSlots = AppointmentSlot::all();
        $events = [];
        $pending = "Pending";
        $onProcess = "On Process";
        $readyToClaim = "Ready to Claim";
        $claimed = "Claimed";
        

        foreach ($appointmentSlots as $appointmentSlot) {
            // fix
            // $appDate = $appointmentSlot->slot_date;
            $start = $appointmentSlot->slot_date;
            // $appDate = Carbon::parse($start)->format('F d, Y');

            // $currentSlot = Appointment::where('appointment_date', $appDate)->count();
            // $pendingSlot = Appointment::where('status', $pending)->where('appointment_date', $appDate)->count();
            // $onProcessSlot = Appointment::where('status', $onProcess)->where('appointment_date', $appDate)->count();
            // $readyToClaimSlot = Appointment::where('status', $readyToClaim)->where('appointment_date', $appDate)->count();
            // $claimedSlot = Appointment::where('status', $claimed)->where('appointment_date', $appDate)->count();

            $currentSlot = Appointment::where('appointment_date', $start)
                ->whereHas('bookings', function ($query) {
                    $query->where('resched', 0);
                })->count();
            $pendingSlot = Appointment::where('status', $pending)
                ->where('appointment_date', $start)
                ->whereHas('bookings', function ($query) {
                    $query->where('resched', 0);
                })->count();
            $onProcessSlot = Appointment::where('status', $onProcess)
                ->where('appointment_date', $start)
                ->whereHas('bookings', function ($query) {
                    $query->where('resched', 0);
                })->count()
            ;$readyToClaimSlot = Appointment::where('status', $readyToClaim)
                ->where('appointment_date', $start)
                ->whereHas('bookings', function ($query) {
                    $query->where('resched', 0);
                })->count()
            ;$claimedSlot = Appointment::where('status', $claimed)
                ->where('appointment_date', $start)
                ->whereHas('bookings', function ($query) {
                    $query->where('resched', 0);
                })->count();


            $title = $currentSlot . ' / '.$appointmentSlot->available_slots;
            $isDisabled = $appointmentSlot->is_disabled ? true : false;
            $slots = $appointmentSlot->available_slots;
            $id = $appointmentSlot->id;
            if($currentSlot === $slots){
                $status = "Full";
            }else{
                $status = "Available";
            }
            $event = [
                'title' => $title,
                'start' => $start,
                'isDisabled' => $isDisabled,
                'slots' => $slots,
                'currentSlot' => $currentSlot,
                'status' => $status,
                'id' => $id,
                'pending' => $pendingSlot,
                'onProcess' => $onProcessSlot,
                'readyToClaim' => $readyToClaimSlot,
                'claimed' => $claimedSlot
            ];
            $events[] = $event;
        }
        return response()->json($events);
    }
    //review ============================ edit slot ==================================
    public function edit(Request $request, $id){
        $appointmentSlot = AppointmentSlot::find($id);
        $appointmentSlot->available_slots = $request->slot;
        $appointmentSlot->is_disabled = $request->disable;
        $appointmentSlot->save();
        return back()->with('success', 'Appointment slot updated successfully.');
    }

}
