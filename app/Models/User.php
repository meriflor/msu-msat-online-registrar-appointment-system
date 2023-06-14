<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Appointment;

use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'firstName',
        'lastName',
        'middleName',
        'suffix',
        'address',
        'school_id',
        'cell_no',
        'civil_status',
        'email',
        'birthdate',
        'status',
        'acadYear',
        'gradYear',
        'gender',
        'course',
        'gender',
    ];
    
     public function bookings()
     {
         return $this->hasMany(Booking::class);
     }
     public function appointments()
     {
         return $this->hasMany(Appointment::class);
     }
}
