<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\Announcement;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\RegistrarStaff;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

use Illuminate\Support\Facades\DB;

use App\Notifications\AppRemarksUpdate;

class subadminViewerController extends Controller
{
    // review dashboard
    public function viewSubAdminRecords(Request $request){
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
        $processedDocs = Appointment::whereNotIn('status', ['Claimed', 'Ready to Claim'])
                            ->where('payment_status', 'Approved')
                            ->get();
        
        return view('subadmin-dashboard.dashboard', compact('bookings', 'todayDocs', 'futureDocs', 'current_day', 'formCounts', 'pendingRequests', 'processedDocs', 'filteredRequests'));
    }

    // review requests by date through calendar
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

        return view('subadmin-dashboard.request', compact('ready', 'claimed', 'thisDay', 'pendingRequests', 'processedDocs'));
    }
    // fix
    public function viewAllRequest(Request $request){
        $bookings = Booking::with('user', 'appointment')
                            ->where('resched', 0)
                            ->whereDoesntHave('appointment', function ($query) {
                                $query->where('status', 'claimed');
                            })->get();
        return view('subadmin-dashboard.request-all', compact('bookings'));
    }
    public function viewAllResched(Request $request){
        $bookings = Booking::with('user', 'appointment')
                            ->where('resched', 1)
                            ->whereDoesntHave('appointment', function ($query) {
                                $query->where('status', 'claimed');
                            })->get();
        return view('subadmin-dashboard.request-resched', compact('bookings'));
    }
    // fix end

    // review pending requests
    public function viewPendingRequests(Request $request){
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
        $pending_payments = Appointment::where('status', 'Confirmed Payment')
                        ->where('payment_status', 'Pending')
                        ->get();
        $pendingRequests = Appointment::where('status', 'Pending')
                        ->where('payment_status', 'Requesting')
                        ->get();
        $processedDocs = Appointment::whereNotIn('status', ['Claimed', 'Ready to Claim'])
                        ->where('payment_status', 'Approved')
                        ->get();
        return view(
            'subadmin-dashboard.pending-requests', 
            compact(
                'requests',
                'pending_payments',
                'pendingRequests',
                'processedDocs',
                'filteredRequests'
                )
        );
    }

    // review processed requests
    public function viewProcessedRequests(Request $request){
        $pending = Appointment::where('status', 'Confirmed Payment')
                    ->where('payment_status', 'Approved')
                    ->get();
        $onprocess = Appointment::where('status', 'On Process')
                    ->where('payment_status', 'Approved')
                    ->get();
        $ready = Appointment::where('status', 'Ready to Claim')
                    ->where('payment_status', 'Approved')
                    ->get();
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
        return view(
            'subadmin-dashboard.processed-requests', 
            compact(
                'pending',
                'onprocess',
                'ready',
                'pendingRequests',
                'processedDocs',
                'filteredRequests'
                )
        );
    }
}
