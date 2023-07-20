<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuryDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injury_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('injury_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('reporting_type')->nullable();
            $table->string('description')->nullable();
            $table->string('injury_document')->nullable();
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
        Schema::dropIfExists('injury_documents');
    }
}
