<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderBillWriteOffReasopnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_bill_write_off_reasopns', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable()->comment('1 for bill write reason, 2 second review, 3 box19 reason');
            $table->integer('provider_id')->nullable();
            $table->string('description')->nullable();
            $table->string('reason_text')->nullable();
            $table->integer('for_all_providers')->nullable();
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
        Schema::dropIfExists('provider_bill_write_off_reasopns');
    }
}
