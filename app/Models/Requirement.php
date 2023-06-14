<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Requirement extends Model
{
    use HasFactory;
    protected $table = 'booking_requirements';
    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }
}
