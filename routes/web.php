<?php

use App\Http\Controllers\subadminViewerController;
use App\Http\Controllers\SubadminCashierController;
use App\Http\Middleware\SubAdminCashier;
use App\Http\Controllers\adminController;
use App\Http\Controllers\announcementController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\faqsController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AdminCheck;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UsersCalendarController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\formController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WebsiteImageContentController;
use App\Http\Middleware\AlreadyLoggedIn;
use App\Http\Middleware\SubAdminView;
use App\Http\Controllers\AppointmentSlotController;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Events\Logout;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([AuthCheck::class,AlreadyLoggedIn::class])->group(function () {
    // Route::get('/dashboard', [CustomAuthController::class, 'appointment'])->name('appointment');
    Route::get('/dashboard', [UserController::class, 'viewUser'])->name('user-dashboard');
    Route::get('/request-records', [UserController::class, 'viewRequestRecords']);
    Route::get('/appointment-records', [UserController::class, 'viewUserAppointments']);
    Route::get('/notification', [UserController::class, 'viewUserNotification']);
    Route::get('/edit-profile', [UserController::class, 'viewUserEditProfile'])->name('edit-profile');
    Route::get('/settings', [UserController::class, 'viewUserSettings']);
    
    //Functions
    Route::delete('/notif-delete/{id}/{notif_type}', [UserController::class, 'notifDelete'])->name('notif-delete');
    Route::get('/unread-notif', [UserController::class, 'unreadNotif'])->name('unread-notif');
    Route::put('/upload-payment', [UserController::class, 'uploadPayment'])->name('payment.upload');
    Route::put('/set-appointment', [UserController::class, 'setAppointment'])->name('set.appointment');
    Route::post('/requirements-upload', [UserController::class, 'reuploadRequirements'])->name('requirements.upload');
});

Route::middleware([AuthCheck::class, AdminCheck::class])->prefix('dashboard-admin')->group(function () {
    Route::get('dashboard',[adminController::class,'viewAdminRecords'])->name('dashboard-admin');
    // Route::get('dashboard/request/{id}', [adminController::class, viewAdminRequest])

    // Admin Functions
    Route::post('announcement-store',[announcementController::class,'storeAnnouncement'])->name('announcement-store');
    Route::post('faq-store',[faqsController::class,'storeFaq'])->name('faq-store');
    Route::get('request/{date}',[adminController::class,'viewAdminRequest'])->name('request');
    Route::post('create-form',[formController::class,'createForm'])->name('create-form'); 
    Route::get('/user/{id}/approved',[adminController::class,'approveUserRegistration'])->name('user-approve'); 
    Route::get('/user/{id}/rejected',[adminController::class,'rejectUserRegistration'])->name('user-reject'); 
    Route::get('/user/{id}/pending',[adminController::class,'pendingUserRegistration'])->name('user-pending'); 
    Route::get('/user-pending-count', [adminController::class,'pendingUserCount'])->name('user-pending-count');
    Route::get('/messages/{id}', [MessageController::class, 'messageViewRequest']);
    Route::post('/settings/update-image/{id}', [WebsiteImageContentController::class, 'updateImage'])->name('updateImage');
    
    //Admin Pages
    Route::any('config',[formController::class,'viewForm'])->name('config');
    Route::get('message',[MessageController::class,'viewMessage']);
    Route::get('announcement',[announcementController::class,'viewAnnouncementAdmin']);
    Route::get('faqs',[faqsController::class,'viewFaqAdmin']);
    Route::get('request-reschedule',[adminController::class,'viewAllResched']);
    Route::get('request-all', [adminController::class,'viewAllRequest']);
    Route::get('settings', [adminController::class,'viewSettings']);
    Route::get('registration-approval', [adminController::class,'viewUserRegistration']);

    //Admin Forms Function
    // Route::get('forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');
    // Route::put('forms/{form}', [FormController::class, 'update'])->name('forms.update');
    // Route::delete('forms/{form}', [FormController::class,'destroy'])->name('forms.destroy');
    
    //Admin settings functions
    Route::post('add-staffs', [SettingsController::class, 'registrarStaffStore'])->name('add-staffs');
    Route::put('edit-staffs/{id}', [SettingsController::class, 'registrarStaffUpdate'])->name('edit-staffs');
    Route::delete('delete-staffs/{id}', [SettingsController::class, 'registrarStaffDelete'])->name('delete-staffs');

    Route::put('admin-contacts-update/{id}', [SettingsController::class, 'adminContactUpdate'])->name('admin-contacts-update');

    Route::post('add-admin-account', [SettingsController::class, 'adminAccountAdd'])->name('add-admin-account');
    Route::put('edit-admin-account/{id}', [SettingsController::class, 'adminAccountUpdate'])->name('edit-admin-account');
    Route::delete('delete-admin-account/{id}', [SettingsController::class, 'adminAccountDelete'])->name('delete-admin-account');
    
});

Route::middleware([AuthCheck::class, SubAdminView::class])->prefix('dashboard-admin-appointments')->group(function () {
    Route::get('/dashboard', [subadminViewerController::class, 'viewSubAdminRecords'])->name('subadmin-dashboard');
    Route::get('request/{date}',[subadminViewerController::class,'viewAdminRequest'])->name('sub-request');
    Route::get('request-reschedule',[subadminViewerController::class,'viewAllResched']);
    Route::get('request-all', [subadminViewerController::class,'viewAllRequest']);
    Route::get('pending-requests', [subadminViewerController::class,'viewPendingRequests']);
    Route::get('processed-requests', [subadminViewerController::class,'viewProcessedRequests']);
});

Route::middleware([AuthCheck::class, SubAdminCashier::class])->prefix('dashboard-admin-cashier')->group(function () {
    Route::get('/dashboard', [SubadminCashierController::class, 'viewCashierDashboard'])->name('subadmin-cashier-dashboard');
    Route::get('/approved-payments', [SubadminCashierController::class, 'viewCashierApproved'])->name('subadmin-cashier-approved');
    Route::get('/incomplete-payments', [SubadminCashierController::class, 'viewCashierIncomplete'])->name('subadmin-cashier-incomplete');

    Route::post('/payment-status-update', [SubadminCashierController::class, 'updatePaymentStatus'])->name('payment-status-update');
});
Route::get('/incomplete-remarks/{id}', [SubadminCashierController::class, 'getIncompleteRemarks']);
Route::get('/requested/{id}', [adminController::class, 'viewInfoRequest']);
// to upload confirmation of payment from the handler side to notify user
Route::post('/confirm-payment', [adminController::class, 'confirmPayment'])->name('payment.confirm');
// to fetch the details of the payments
Route::get('/payments/{id}', [adminController::class, 'paymentsInfo']);
// updating the request status, accept, done, claimed
Route::put('update-status', [adminController::class, 'updateStatus'])->name('update.status');


    //Login and Registraion - Personal Information
    Route::post('/registration-user',[CustomAuthController::class,'registerUser'])->name('registration-user');  
    Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('login-user');
    Route::get('/logout',[CustomAuthController::class,'logout'])->name('logout');
    Route::post('/updateProfile', [CustomAuthController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/bookAppointment',[CustomAuthController::class,'bookAppointment'])->name('bookAppointment');

    //Working in announcements -> temporary
    Route::get('/',[announcementController::class,'showAnnouncement'])->name('announcement');
    Route::get('announcement',[announcementController::class,'dashboardAnnouncement'])->name('announcement.dashboard');


    //faqs sa user side dapit -> temporary
    Route::get('/faqs',[faqsController::class,'index'])->name('faqs');
    

    //Para ni sa Crud sa calendar -> wala pani sure,, test rani
    Route::get('appointment_slots', [AppointmentSlotController::class, 'events'])->name('appointment_slots.events');
    // Route::post('/appointment_slots', [AppointmentSlotController::class, 'store']);
    Route::post('/appointment_slots', [AppointmentSlotController::class, 'store'])->name('appointment_slots.store');
    Route::put('/appointment_slots/{appointmentSlot}', [AppointmentSlotController::class, 'update']);
    Route::delete('/appointment_slots/{appointmentSlot}', [AppointmentSlotController::class, 'destroy']);


    //Bookings Status
    Route::get('bookings/{id}', [adminController::class, 'viewApp']);
    // Route::put('acceptStatus', [adminController::class, 'updateStatusAccept'])->name('acceptStatus');
    // Route::put('doneStatus', [adminController::class, 'updateStatusDone'])->name('doneStatus');
    // Route::put('claimedStatus', [adminController::class, 'updateStatusClaimed'])->name('claimedStatus');
    // Route::put('reschedule-request', [UserController::class, 'reschedAppointment'])->name('reschedule');

    Route::get('form/{id}',[formController::class,'viewOneForm']);  
    Route::put('edit-form',[formController::class,'editForm'])->name('editform');
    Route::delete('form/delete/{id}',[formController::class,'delete'])->name('deleteform');  

    Route::get('announcement/{id}',[announcementController::class,'viewOneAnnouncement']);  
    Route::put('edit-announcement',[announcementController::class,'editAnnouncement'])->name('editannouncement');
    Route::delete('announcement/delete/{id}',[announcementController::class,'delete'])->name('deleteannouncement');  

    //testing -> course
    Route::post('store-course',[courseController::class,'storeCourse'])->name('store-course');
    Route::put('edit-course',[courseController::class,'editCourse'])->name('editcourse');
    Route::delete('course/delete/{id}',[courseController::class,'delete'])->name('deletecourse');  

    //testing -> faqs
    Route::get('faq/{id}',[faqsController::class,'viewOneFaq']);  
    Route::put('edit-faq',[faqsController::class,'editFaq'])->name('editfaq');
    Route::delete('faq/delete/{id}',[faqsController::class,'delete'])->name('deletefaq');  


    Route::delete('/appointment_slots/{appointmentSlot}', [AppointmentSlotController::class, 'destroy'])->name('appointment_slots.destroy');
    Route::put('appointment_slots/edit/{id}', [AppointmentSlotController::class, 'edit'])->name('slot.edit');

    Route::delete('appointment/delete/{id}',[CustomAuthController::class,'cancel_appointment'])->name('cancelappointment');  
    Route::put('appointment/remarks', [adminController::class,'updateRemark'])->name('appointmentremarks');

    //Message
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

