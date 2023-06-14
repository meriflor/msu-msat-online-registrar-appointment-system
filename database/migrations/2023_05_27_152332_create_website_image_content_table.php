<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteImageContentTable extends Migration
{
    
    public function up()
    {
        Schema::create('website_image_content', function (Blueprint $table) {
            $table->id();
            $table->string('image_name')->nullable();
            $table->string('file_name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('website_image_content');
    }
}
