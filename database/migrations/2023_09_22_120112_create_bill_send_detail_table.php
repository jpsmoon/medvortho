<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillSendDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_send_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('injury_id')->unsigned()->nullable();
            //$table->foreign('injury_id')->references('id')->on('patient_injuries');
            $table->integer('patient_id')->unsigned()->nullable();
            //$table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('bill_id')->unsigned()->nullable();
            //$table->foreign('bill_id')->references('id')->on('injury_bills');
            $table->enum('send_type', array('1', '2','3'))->default('1')->comment('1 for rcm, 2 for fax, 3 for download pdf');
            $table->string('fax_type');
            $table->string('fax_number');
            $table->string('fax_attention');
            $table->string('pdf_packet_name');
            $table->string('pdf_packet_url'); 
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('bill_send_detail');
    }
}
