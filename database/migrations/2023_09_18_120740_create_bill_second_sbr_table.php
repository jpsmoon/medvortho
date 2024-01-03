<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillSecondSbrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_second_sbr', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            $table->integer('bill_service_procedure_code_id')->nullable();
            $table->integer('review_id')->nullable();
            $table->integer('document_id')->nullable();
            $table->string('review_text')->nullable();
            $table->string('service_good')->nullable();
            $table->string('attched_document')->nullable();
            $table->string('sbr_name')->nullable();
            $table->string('sbr_path')->nullable();
            $table->integer('sbr_status')->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
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
        Schema::dropIfExists('bill_second_sbr');
    }
}
