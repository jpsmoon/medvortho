<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBillingProviderChargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_billing_provider_charge', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->nullable();
            $table->integer('charge_id')->nullable();
            $table->text('ctype', 5)->nullable();
            $table->text('practice_name')->nullable();
            $table->text('states_code')->nullable();
            $table->text('effective_dos')->nullable();
            $table->text('expiration_dos')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('master_billing_provider_charge');
    }
}
