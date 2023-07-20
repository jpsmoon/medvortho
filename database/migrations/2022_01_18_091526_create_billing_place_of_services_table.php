<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingPlaceOfServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_place_of_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billing_provider_id')->unsigned();
            $table->integer('service_code_id')->unsigned()->nullable();
            $table->string('npi', 15);
            $table->string('location_name', 55);
            $table->string('nick_name', 25);
            $table->mediumText('address_line1')->nullable();
            $table->mediumText('address_line2')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('billing_provider_id')->references('id')->on('billing_providers');
            // $table->foreign('service_code_id')->references('id')->on('service_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_place_of_services');
    }
}
