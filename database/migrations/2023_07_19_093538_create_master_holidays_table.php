<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('holiday_date')->nullable();
            $table->string('holiday_name')->nullable();
            $table->string('holiday_month')->nullable();
            $table->string('holiday_year')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('description')->nullable();
            $table->integer('updated_by')->nullable();
            $table->enum('holiday_type', array('1', '0'))->default('1')->comment('1 for gazetted holidays 0 for restricted holiday');
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
        Schema::dropIfExists('master_holidays');
    }
}
