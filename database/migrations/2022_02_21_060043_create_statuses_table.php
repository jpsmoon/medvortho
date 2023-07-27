<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name', 55);
            $table->integer('display_order');
            $table->mediumText('description');
            $table->enum('is_active', array('1', '0'))->default('1');
            $table->integer('status_type')->nullable()->comment('1 for patient and 2 for Injury and 3 for bill and 4 appointment and 5 for other');
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
        Schema::dropIfExists('statuses');
    }
}
