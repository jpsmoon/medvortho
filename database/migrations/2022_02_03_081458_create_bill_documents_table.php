<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id');
            $table->string('document_name', 155)->nullable();
            $table->string('document_path', 155);
            $table->mediumText('description')->nullable();
            $table->integer('report_type_id')->nullable();
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
        Schema::dropIfExists('bill_documents');
    }
}
