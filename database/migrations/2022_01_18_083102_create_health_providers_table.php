<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('npi', 15);
            $table->enum('entity_type', array('Person', 'Non-Person'));
            $table->string('entity_name', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('mi', 25)->nullable();
            $table->string('suffix', 15)->nullable();
            $table->integer('taxonomy_code_id')->nullable();
            $table->enum('provider_type', array('Physician', 'Non-physician practitioner', 'Clinical social worker'));
            $table->string('signature', 155);            
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('taxonomy_code_id')->references('id')->on('taxonomy_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_providers');
    }
}
