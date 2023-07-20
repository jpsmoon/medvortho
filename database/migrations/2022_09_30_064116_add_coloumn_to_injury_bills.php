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
            //
            $table->string('dos_end')->nullable();
            $table->string('bill_provider_name')->nullable();
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
