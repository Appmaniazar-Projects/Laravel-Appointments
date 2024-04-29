<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('employee_service', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->nullable();

            $table->string('employee_name')>nullable();

            $table->foreign('employee_id', 'employee_id_fk_360622')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedInteger('service_id');

            $table->foreign('service_id', 'service_id_fk_360622')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('employee_service', function (Blueprint $table) {
            $table->dropForeign('employee_id_fk_360622');
            $table->dropForeign('service_id_fk_360622');
        });

        Schema::dropIfExists('employee_service');
    }
}
