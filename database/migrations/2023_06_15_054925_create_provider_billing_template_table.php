<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderBillingTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_billing_template', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('billing_providers')->onDelete('cascade');
            $table->string('template_name')->nullable();
            $table->string('description')->nullable();
            $table->enum('is_active', array('1', '0'));
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('provider_billing_template');
    }
}
