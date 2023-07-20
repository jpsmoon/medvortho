<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimMailBillTreatmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_mail_bill_treatment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('claim_mail_id')->unsigned();
            $table->integer('bill_treatment_type_id')->unsigned();
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
        Schema::dropIfExists('claim_mail_bill_treatment_types');
    }
}
