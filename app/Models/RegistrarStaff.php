<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrarStaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'position',
        'profile_image',
    ];

    protected $table = 'registrar_staffs';
}
