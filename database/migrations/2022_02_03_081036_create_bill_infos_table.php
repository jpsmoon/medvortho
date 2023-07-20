<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_code_id')->unsigned();
            $table->integer('health_provider_id')->unsigned();
            $table->string('authorization_no', 55)->nullable();
            $table->string('practice_bill_id', 55)->nullable();
            $table->date('start_dos');
            $table->date('admission_date')->nullable();
            $table->date('end_dos')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('diagnosis_code_type', 55)->nullable();
            $table->decimal('write_off_amt', 10, 2)->nullable();
            $table->mediumText('write_off_reason')->nullable();
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();                        
            $table->foreign('service_code_id')->references('id')->on('service_codes');
            $table->foreign('health_provider_id')->references('id')->on('health_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_infos');
    }
     
}
