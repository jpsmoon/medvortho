<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mpn_no', 55);
            $table->string('applicant_name', 155);
            $table->string('applicant_type', 55);
            $table->string('mpn_name', 155)->nullable();
            $table->date('approval_date')->nullable();
            $table->string('website_url', 255)->nullable();
            $table->string('mpn_status', 55)->default('Pending');
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
        Schema::dropIfExists('medical_providers');
    }
}
