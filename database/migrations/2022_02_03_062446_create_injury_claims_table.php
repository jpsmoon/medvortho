<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuryClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injury_claims', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('injury_id')->unsigned();
            //first financial class step
            $table->string('employer_name', 100)->nullable();
            $table->enum('is_cumulative', array('Yes', 'No'));
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('claim_admin_id')->nullable();
            $table->enum('no_any_claim', array('1', '0'))->default('0');
            $table->integer('payer_id')->nullable();
            $table->string('claim_no', 55)->nullable();
            $table->string('claim_status_id')->nullable();
            $table->date('claim_status_date')->nullable();
            $table->integer('medical_provider_id')->nullable();
            $table->integer('no_any_medical_provider')->nullable();
            $table->string('adj_no', 55)->nullable();
            $table->mediumText('emp_address_line1')->nullable();
            $table->mediumText('emp_address_line2')->nullable();
            $table->string('emp_city_id')->nullable();
            $table->string('emp_state_id')->nullable();
            $table->string('emp_zipcode', 15)->nullable();
            //second financial class step
            $table->string('ins_payer', 55)->nullable();
            $table->string('ins_subscriber', 55)->nullable();
            $table->string('ins_group_no', 25)->nullable();
            $table->decimal('ins_deduct_amt', 10, 2)->nullable();
            $table->decimal('ins_copay_amt', 10, 2)->nullable();
            $table->decimal('ins_coins_amt', 10, 2)->nullable();
            $table->mediumText('ins_authinfo')->nullable();
            $table->integer('ins_no_of_visit')->nullable();
            //third financial class step
            $table->string('p_attorney_name', 100)->nullable();
            $table->string('p_payer_name', 100)->nullable();
            $table->string('p_law_officer_name', 100)->nullable();
            $table->date('p_injury_date')->nullable();
            $table->string('p_claim_id', 55)->nullable();
            $table->string('p_ssn_no', 55)->nullable();
            $table->string('p_handle_attorn_individual', 100)->nullable();
            $table->string('p_contact_no', 15)->nullable();
            $table->mediumText('p_others')->nullable();
            $table->mediumText('p_address_line1')->nullable();
            $table->mediumText('p_address_line2')->nullable();
            $table->integer('p_city_id')->nullable();
            $table->integer('p_state_id')->nullable();
            $table->string('p_zipcode', 15)->nullable();

            $table->enum('is_active', array('1', '0'))->default('1');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('injury_id')->references('id')->on('patient_injuries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('injury_claims');
    }
}
