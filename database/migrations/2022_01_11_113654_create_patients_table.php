<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billing_provider_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('mi', 25)->nullable();
            $table->string('suffix', 15)->nullable();
            $table->date('dob');
            $table->enum('gender', array('Male', 'Female', 'Others'));
            $table->string('ssn_no', 25);
            $table->string('contact_no', 15)->nullable();
            $table->string('practice_id', 55)->nullable();
            $table->string('email', 100)->nullable();
            $table->mediumText('address_line1')->nullable();
            $table->mediumText('address_line2')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
