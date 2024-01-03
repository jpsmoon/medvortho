<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentBillInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_bill_information', function (Blueprint $table) {
            $table->id();
            $table->integer('bil_id'); 
            $table->integer('sent_by'); 
            $table->text('sent_date')->nullable();
            $table->enum('sent_type', array('1', '2','3'))->default('1')->comment('1 for Via RCMBill, 2 for Fax, 3 for download PDF'); //1 for Via RCMBill, 2 for Fax, 3 for Download PDF
            $table->enum('fax_type', array('1', '2'))->default('1')->comment('1 for custom, 2 for adjustor'); //1 for Custom, 2 for Adjustor
            $table->text('fax_number', 100)->nullable();
            $table->text('fax_attention')->nullable();
            $table->text('pdf_claim_admin_id')->nullable();
            $table->text('pdf_path')->nullable();
            $table->integer('status_id')->nullable();
            $table->enum('bill_type', array('1', '2'))->default('1')->comment('1 for original, 2 duplicate'); //1 for original, 2 duplicate
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
        Schema::dropIfExists('sent_bill_information');
    }
}
