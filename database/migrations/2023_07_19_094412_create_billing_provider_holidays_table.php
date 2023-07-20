<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingProviderHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_provider_holidays', function (Blueprint $table) {
            $table->id();
            $table->integer('holiday_id')->nullable();
            $table->integer('billing_provider_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('description')->nullable();
            $table->string('holiday_start_time')->nullable();
            $table->string('holiday_end_time')->nullable();
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
        Schema::dropIfExists('billing_provider_holidays');
    }
}
