<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderChargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_charge', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->nullable();
            $table->integer('type')->nullable();//1 for practice charge
            $table->text('state_id')->nullable();
            $table->bigInteger('physician_services')->nullable();
            $table->bigInteger('pathology')->nullable();
            $table->bigInteger('med_legal')->nullable();
            $table->bigInteger('dmepos')->nullable();
            $table->bigInteger('dispensed_pharmaceuticals')->nullable();
            $table->bigInteger('copy_service')->nullable();
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
        Schema::dropIfExists('provider_charge');
    }
}
