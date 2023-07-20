<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuryBillServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injury_bill_services', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            //$table->foreign('bill_id')->references('id')->on('injury_bills');
            $table->string('bill_procedure_code');
            $table->string('bill_modifiers');
            $table->string('bill_units');
            $table->string('bill_diag_codes1')->nullable();
            $table->string('bill_diag_codes2')->nullable();
            $table->string('bill_diag_codes3')->nullable();
            $table->string('bill_diag_code4')->nullable();
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
        Schema::dropIfExists('injury_bill_service');
    }
}
