<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillProcedureCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_procedure_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id');
            $table->integer('procedure_code_id');
            $table->integer('modifier_id');
            $table->integer('unit');
            $table->mediumText('description');
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
        Schema::dropIfExists('bill_procedure_codes');
    }
}
