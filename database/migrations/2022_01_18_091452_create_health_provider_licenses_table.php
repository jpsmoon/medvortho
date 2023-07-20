<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthProviderLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_provider_licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_provider_id')->unsigned();
            $table->string('licenseno', 100);
            $table->integer('state_id')->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('health_provider_id')->references('id')->on('health_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_provider_licenses');
    }
}
