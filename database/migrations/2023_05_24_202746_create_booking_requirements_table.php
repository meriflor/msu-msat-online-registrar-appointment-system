<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRequirementsTable extends Migration
{
    public function up()
    {
        Schema::create('booking_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_name');
            $table->unsignedInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('appointments');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_requirements');
    }
}
