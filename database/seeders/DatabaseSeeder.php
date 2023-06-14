<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(FormSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WebsiteImageContentSeeder::class);
    }
}
