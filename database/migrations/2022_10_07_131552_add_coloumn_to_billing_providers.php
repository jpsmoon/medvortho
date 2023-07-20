<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnToBillingProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billing_providers', function (Blueprint $table) {
            //
            // $table->text('injury_state_id')->nullable();
            // $table->text('bill_type')->nullable();
            // $table->text('provider_type')->nullable();

            $table->text('professional_tax_id')->nullable();
            $table->text('professional_provider_name')->nullable();
            $table->text('professional_nick_name')->nullable();
            $table->text('professional_telephone')->nullable();
            $table->text('professional_addres1')->nullable();
            $table->text('professional_addres2')->nullable();
            $table->text('professional_city')->nullable();
            $table->text('professional_state')->nullable();
            $table->text('professional_zip')->nullable();
            $table->text('professional_npi')->nullable();
            $table->text('professional_address1')->nullable();
            $table->text('professional_address2')->nullable();
            $table->text('professional_city1')->nullable();
            $table->text('professional_state1')->nullable();
            $table->text('professional_zipcode1')->nullable();
            $table->text('billProvider_box_25_tax_id')->nullable();
            $table->text('billProvider_namebox_33_first_name')->nullable();
            $table->text('billProvider_namebox_33_last_name')->nullable();
            $table->text('billProvider_namebox_33_mi')->nullable();
            $table->text('billProvider_namebox_33_suffix')->nullable();
            $table->text('billProvider_namebox_33_telephone')->nullable();
            $table->text('billProvider_namebox_33_address1')->nullable();
            $table->text('billProvider_namebox_33_address2')->nullable();
            $table->text('billProvider_namebox_33_city')->nullable();
            $table->text('billProvider_namebox_33_state')->nullable();
            $table->text('billProvider_namebox_33_zipCode')->nullable();
            $table->text('billProvider_namebox_33_npi')->nullable();
            $table->text('billProvider_namebox_33_a_address1')->nullable();
            $table->text('billProvider_namebox_33_a_address2')->nullable();
            $table->text('billProvider_namebox_33_a_city')->nullable();
            $table->text('billProvider_namebox_33_a_stateId')->nullable();
            $table->text('billProvider_namebox_33_a_zipcode')->nullable();
            $table->text('professional_file')->nullable();
            $table->text('professional_user_with_access')->nullable();
            $table->text('professional_fax_number')->nullable();
            $table->text('pharmacy_tax_id')->nullable();
            $table->text('pharmacy_billing_provider_name')->nullable();
            $table->text('pharmacy_billing_nick_name')->nullable();
            $table->text('pharmacy_address1')->nullable();
            $table->text('pharmacy_address2')->nullable();
            $table->text('pharmacy_city')->nullable();
            $table->text('pharmacy_state')->nullable();
            $table->text('pharmacy_zipcode')->nullable();
            $table->text('pharmacy_telephone')->nullable();
            $table->text('pharmacy_signature')->nullable();
            $table->text('pharmacy_npi')->nullable();
            $table->text('pharmacy_billing_address1')->nullable();
            $table->text('pharmacy_billing_address2')->nullable();
            $table->text('pharmacy_billing_city')->nullable();
            $table->text('pharmacy_billing_state')->nullable();
            $table->text('pharmacy_billing_zipcode')->nullable();
            $table->text('pharmacy_billing_file')->nullable();
            $table->text('pharmacy_billing_user_access')->nullable();
            $table->text('pharmacy_billing_fax_number')->nullable();
            $table->text('institution_provider_name')->nullable();
            $table->text('institution_nick_name')->nullable();
            $table->text('institution_telephone')->nullable();
            $table->text('institution_address1')->nullable();
            $table->text('institution_address2')->nullable();
            $table->text('institution_city')->nullable();
            $table->text('institution_state')->nullable();
            $table->text('institution_zipCode')->nullable();
            $table->text('institution_address11')->nullable();
            $table->text('institution_address22')->nullable();
            $table->text('institution_city1')->nullable();
            $table->text('institution_state1')->nullable();
            $table->text('institution_zipCode1')->nullable();
            $table->text('institution_tax_id')->nullable();
            $table->text('institution_npi')->nullable();
            $table->text('institution_taxonomy')->nullable();
            $table->text('institution_file')->nullable();
            $table->text('institution_county_name')->nullable();
            $table->text('institution_facility_type')->nullable();
            $table->text('institution_file2')->nullable();
            $table->text('institution_user_acess')->nullable();
            $table->text('institution_fax_number')->nullable();
            $table->text('dol_provider_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billing_providers', function (Blueprint $table) {
            //
        });
    }
}
