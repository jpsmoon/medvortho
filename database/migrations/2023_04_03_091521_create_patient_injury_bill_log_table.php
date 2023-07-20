<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientInjuryBillLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_injury_bills_log', function (Blueprint $table) {
            $table->id();
            $table->integer('assign_task_id')->nullable();
            $table->string('type')->nullable();
            $table->string('created_by')->nullable();
            $table->string('description')->nullable();
            $table->string('due_date')->nullable();
            $table->string('complete_date')->nullable();
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
        Schema::dropIfExists('patient_injury_bill_log');
    }
}
