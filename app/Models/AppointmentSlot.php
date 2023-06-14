<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'slot_date',
        'available_slots',
        'is_disabled',
    ];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
