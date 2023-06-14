<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->firstName = 'Admin';
        $user->lastName = 'Admin';
        $user->middleName = '';
        $user->suffix = '';
        $user->address = 'Tubod Lanao del Norte';
        $user->school_id = '100949';
        $user->cell_no = '09357257056';
        $user->civil_status = 'Single';
        $user->email = 'admin@gmail.com';
        $user->birthdate = '2000-08-17';
        $user->status = 'Admin';
        $user->gender = 'Male';
        $user->course = '';
        $user->password = Hash::make('admin123');
        $user->acadYear = '2022-2023';
        $user->gradYear = '';
        $user->account_status = 'Pending';
        $user->account_rejected = null;
        $user->account_approved = null;
        $user->role = 1;
        $user->save();  
    }
}
