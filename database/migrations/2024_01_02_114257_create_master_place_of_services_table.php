<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPlaceOfServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_place_of_services', function (Blueprint $table) {
            $table->id();
            $table->integer('billing_provider_id')->nullable();
            $table->integer('service_code_id')->nullable();
            $table->string('npi')->nullable();
            $table->string('location_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('zipcode')->nullable(); 
            $table->enum('is_active', array('1', '0'))->default('1');
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
        Schema::dropIfExists('master_place_of_services');
    }
}
