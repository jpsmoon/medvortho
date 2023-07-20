<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimMailAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_mail_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('claim_admin_id')->unsigned();
            $table->string('company_name', 55);
            $table->mediumText('address_line1')->nullable();
            $table->mediumText('notes')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('claim_admin_id')->references('id')->on('claim_administrators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_mail_addresses');
    }
}
