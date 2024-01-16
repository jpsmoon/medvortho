<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillCoverSheetCmsFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_cover_sheet_cms_form', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            $table->integer('sent_id')->nullable();
            $table->string('temp_document_name')->nullable();
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
        Schema::dropIfExists('bill_cover_sheet_cms_form');
    }
}
