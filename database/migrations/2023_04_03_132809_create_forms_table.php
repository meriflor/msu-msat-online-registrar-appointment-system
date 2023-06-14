<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('form_requirements');
            $table->string('form_process');
            $table->text('form_avail');
            $table->text('form_who_avail');
            $table->text('form_max_time');

            //additional
            $table->integer('fee'); //document fee
            $table->text('fee_type'); //fee type like per page, collected aspart of graduation fee or none
            $table->text('pages');

            
            $table->boolean('acad_year')->default(0);
            $table->boolean('requirements')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
