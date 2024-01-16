<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumToInjuryClaims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('injury_claims', function (Blueprint $table) {
            //
            $table->string('is_employer_address_optional')->nullable();
            $table->string('practice_internal_id')->nullable();
            $table->string('employer_phone_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('injury_claims', function (Blueprint $table) {
            //
        });
    }
}
