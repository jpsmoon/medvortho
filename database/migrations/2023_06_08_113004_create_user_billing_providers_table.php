<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBillingProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_billing_providers', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->nullable();
            $table->integer('user_id')->nullable();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('provider_id')->references('id')->on('billing_providers')->onDelete('cascade');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('user_billing_providers');
    }
}
