<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillReferingOrderingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_refering_ordering', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable();//1 for referring, 2 for Supervising, 3 for Ordering, 4 for rendering
            $table->string('referring_provider_npi')->nullable();
            $table->string('referring_provider_first_name')->nullable();
            $table->string('referring_provider_last_name')->nullable();
            $table->string('referring_provider_middle_name')->nullable();
            $table->string('referring_provider_suffix')->nullable();
            $table->string('referring_provider_state_id')->nullable();
            $table->string('referring_provider_license_number')->nullable();
            $table->string('billing_provider_id')->nullable();
            $table->integer('taxonomy_code')->nullable();
            $table->string('provider_type')->nullable();
            $table->string('provider_name_type')->nullable();
            $table->string('entity_name')->nullable();
            $table->string('referring_provider_image')->nullable();
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
        Schema::dropIfExists('bill_refering_ordering');
    }
}
