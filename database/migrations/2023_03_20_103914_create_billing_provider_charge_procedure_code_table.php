<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingProviderChargeProcedureCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_provider_charge_procedure_code', function (Blueprint $table) {
            $table->id();
            $table->integer('billing_provider_charge_id');
            $table->text('procedure_code')->nullable();
            $table->integer('modifiers')->nullable();
            $table->text('units')->nullable();
            $table->enum('status', array('1', '0'))->default('1');
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
        Schema::dropIfExists('billing_provider_charge_procedure_code');
    }
}
