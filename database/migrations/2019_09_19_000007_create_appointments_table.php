<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->increments('id');

            
            $table->string('name')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('employee_name')->nullable();


            $table->datetime('start_time');

            $table->datetime('finish_time');

            $table->integer('capacity')->nullable();

            $table->longText('comments')->nullable();
            $table->string('alcohol_sales')->nullable();
            $table->string('ems_approval')->nullable();
            $table->string('evac_points')->nullable();
            $table->string('noise')->nullable();
            $table->datetime('pstart_time');

            $table->datetime('pfinish_time');
            $table->integer('parking_id')->nullable();
            $table->timestamps();
           // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');

            $table->softDeletes();
        });
    }
}
