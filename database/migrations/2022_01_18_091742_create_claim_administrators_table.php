<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_administrators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 155);
            $table->string('alias', 25)->nullable();
            $table->integer('company_type_id')->nullable();
            $table->text('description')->nullable();
            $table->string('payer_id', 25)->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('email', 55)->nullable();
            $table->string('website', 155)->nullable();
            $table->text('bill_process_flow')->nullable();
            $table->mediumText('bill_process_flow_note')->nullable();
            $table->string('admin_fax_no', 255)->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->string('admin_address', 255)->nullable();
            $table->string('clearing_house', 255)->nullable();
            $table->string('time_zone_type', 255)->nullable();
            $table->string('bill_portal', 255)->nullable();
            $table->string('affiliated_entries', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
           // $table->foreign('company_type_id')->references('id')->on('company_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_administrators');
    }
}
