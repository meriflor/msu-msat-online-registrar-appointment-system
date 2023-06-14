<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
class Form extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'form_requirements',
        'form_process',
        'fee',
        'form_avail',
        'form_who_avail',
        'form_max_time',
        'acad_year',
        'requirements',


    ];

     public function appointments()
     {
         return $this->hasMany(Appointment::class);
     }
}
