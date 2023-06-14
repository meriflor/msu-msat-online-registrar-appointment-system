<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteImageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageContent = new \App\Models\WebsiteImageContent([
            'id' => 1,
            'image_name' => 'Main Page',
            'file_name' => 'images/registrar04.jpg',
        ]);
        $imageContent -> save();

        $imageContent = new \App\Models\WebsiteImageContent([
            'id' => 2,
            'image_name' => 'Faqs and Announcement',
            'file_name' => 'images/registrar05.jpg',
        ]);
        $imageContent -> save();

        $imageContent = new \App\Models\WebsiteImageContent([
            'id' => 3,
            'image_name' => 'About',
            'file_name' => 'images/registrar04.jpg',
        ]);
        $imageContent -> save();
    }
}
