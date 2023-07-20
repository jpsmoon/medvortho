<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 55);
            $table->string('place_of_service_name', 55);
            $table->string('nick_name', 55)->nullable();
            $table->string('npi', 15);
            $table->mediumText('address_line1')->nullable();
            $table->mediumText('address_line2')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_codes');
    }
}
