<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModifierCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifier_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modifier_name', 55);
            $table->string('modifier_code', 10);
            $table->mediumText('description');
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
        Schema::dropIfExists('modifier_codes');
    }
}
