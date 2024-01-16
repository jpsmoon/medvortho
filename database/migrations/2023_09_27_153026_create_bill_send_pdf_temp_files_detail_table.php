<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillSendPdfTempFilesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_send_pdf_temp_files_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            //$table->foreign('bill_id')->references('id')->on('injury_bills');
            $table->string('temp_document_name');
            $table->integer('doc_type')->nullable();
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
        Schema::dropIfExists('bill_send_pdf_temp_files_detail');
    }
}
