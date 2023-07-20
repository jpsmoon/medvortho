<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('billing_provider_id');
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->integer('location')->nullable();
            $table->string('resource', 200)->nullable();
            $table->string('recurrene', 200)->nullable();
            $table->integer('appointment_reason', 200)->nullable();
            $table->integer('meeting_type', 200)->nullable();
            $table->string('duration', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('arrival_time', 200)->nullable();
            $table->string('notes', 200)->nullable();
            $table->string('last_edited_by_id', 200)->nullable();
            $table->string('created_by', 200)->nullable();
            $table->string('authorised')->nullable();
            $table->integer('case_id')->nullable();
            $table->integer('rendering_provider_id');
            $table->string('appointment_addition_info')->nullable();
            $table->string('is_interpreter')->nullable();


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
        Schema::dropIfExists('patient_appointment');
    }
}
