<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Form;
use App\Models\User;
use App\Models\Payment;

// use Illuminate\Notifications\Notifiable;
class Appointment extends Model
{

    use HasFactory;

    protected $fillable = [
        'app_purpose',
        'acad_year',
        'booking_number',
        'appointment_date',
        'payment_method',
        'proof_of_payment',
       
    ];

     public function form()
     {
         return $this->belongsTo(Form::class);
     }

     public function bookings()
     {
    
         return $this->hasMany(Booking::class);
     }
    
     public function user()
     {
         return $this->belongsTo(User::class);
     }
     public function appointmentSlots()
     {
         return $this->hasMany(AppointmentSlot::class);
     }
     public function payments()
     {
         return $this->hasMany(Payment::class);
     }
}
