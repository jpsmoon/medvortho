<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('injury_state_id')->nullable();
            $table->enum('bill_type', array('Professional', 'Pharmacy', 'Institutional'));
            $table->enum('provider_type', array('Organization', 'Individual'));
            $table->string('tax_id', 25);
            $table->string('npi', 15);
            $table->string('name', 155);
            $table->string('nick_name', 50)->nullable();
            $table->string('contact_no', 15)->nullable();
            $table->string('fax_no', 25)->nullable();
            $table->mediumText('address_line1')->nullable();
            $table->mediumText('address_line2')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('dol_no', 55)->nullable();
            $table->mediumText('payto_address_line1')->nullable();
            $table->mediumText('payto_address_line2')->nullable();
            $table->string('payto_city_id')->nullable();
            $table->string('payto_state_id')->nullable();
            $table->string('payto_zipcode', 15)->nullable();
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
        Schema::dropIfExists('billing_providers');
    }
}
