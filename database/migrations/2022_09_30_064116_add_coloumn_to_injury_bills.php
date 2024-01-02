<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnToInjuryBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('injury_bills', function (Blueprint $table) {
            $table->string('dos_end')->nullable();
            $table->string('bill_provider_name')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->integer('template_id')->nullable();
            $table->integer('bill_stage')->nullable();
            $table->integer('bill_status')->nullable();
            $table->integer('task_status')->nullable();
            $table->integer('bill_provider_write_of_reason')->nullable();
            $table->integer('write_of_reason_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('injury_bills', function (Blueprint $table) {
            //
            $table->string('dos_end')->nullable();
            $table->string('bill_provider_name')->nullable();
        });
    }
}
