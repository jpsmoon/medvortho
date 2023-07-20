<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimAuthContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_auth_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('claim_admin_id')->unsigned();
            $table->string('rfa_contact_no', 25)->nullable();
            $table->string('rfa_fax_no', 25)->nullable();
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
        Schema::dropIfExists('claim_auth_contacts');
    }
}
