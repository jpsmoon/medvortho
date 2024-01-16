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
            $table->integer('patient_id')->nullable();
            //$table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('billing_provider_id')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('appointment_time')->nullable();
            $table->integer('location')->nullable();
            $table->string('resource')->nullable();
            $table->string('recurrene')->nullable();
            $table->integer('appointment_reason')->nullable();
            $table->integer('meeting_type')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('notes')->nullable();
            $table->string('last_edited_by_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('authorised')->nullable();
            $table->integer('case_id')->nullable();
            $table->integer('rendering_provider_id')->nullable();
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
