<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuryDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injury_diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('injury_claim_id')->unsigned();
            $table->integer('diagnosis_code_id')->unsigned();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();                        
            $table->foreign('injury_claim_id')->references('id')->on('injury_claims');
            $table->foreign('diagnosis_code_id')->references('id')->on('diagnosis_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('injury_diagnoses');
    }
}
