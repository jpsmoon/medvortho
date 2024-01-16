<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderBillingTemplateServiceLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_billing_template_service_line_items', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->unsigned();
            //$table->foreign('provider_id')->references('id')->on('billing_providers')->onDelete('cascade');
            $table->integer('template_id')->unsigned();
            //$table->foreign('template_id')->references('id')->on('provider_billing_template')->onDelete('cascade');
            $table->string('procedure_code')->nullable();
            $table->integer('modifiers_id')->nullable();
            $table->string('units')->nullable();
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
        Schema::dropIfExists('provider_billing_template_service_line_items');
    }
}
