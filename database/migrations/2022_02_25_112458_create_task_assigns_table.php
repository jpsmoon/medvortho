<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_no', 55);
            $table->integer('user_id');
            $table->integer('task_id');
            $table->integer('assign_user_id')->nullable();
            $table->integer('assign_by_user_id')->nullable();
            $table->date('assign_by_date')->nullable();
            $table->integer('step_id');
            $table->integer('task_step_id');
            $table->integer('status_id');
            $table->string('status_alias', 55)->nullable();
            $table->date('close_date')->nullable();
            $table->integer('close_status')->nullable();
            $table->integer('close_by')->nullable();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('task_assigns');
    }
}
