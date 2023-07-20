<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

    class BillPlaceServiceCodeSeeder extends Seeder
    {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //
    \DB::table('bill_place_service_codes')->insert([
        [
        'service_code' =>'01',
        'name' =>'Pharmacy',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now()
        ],
        [
            'service_code' =>'02',
            'name' =>'Telehealth',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'03',
            'name' =>'School',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'04',
            'name' =>'Homeless Shelter',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'05',
            'name' =>"Indian Health Service Free standing Facility",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'06',
            'name' =>"Indian Health Service Provider-based Facility",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' => '07',
            'name' =>"Tribal 638 Free standing Facility",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' => '08',
            'name' =>"Tribal 638 Provider based Facility",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'09',
            'name' =>'Prison Correctional Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'10',
            'name' =>'Telehealth Provided in Patient’s Home',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'11',
            'name' =>'Office',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'12',
            'name' =>'Home',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'13',
            'name' =>'Assisted Living Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'14',
            'name' =>'Group Home',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'15',
            'name' =>'Mobile Unit',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'16',
            'name' =>'Temporary Lodging',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'17',
            'name' =>'Walk-in Retail Health Clinic',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'19',
            'name' =>'Off Campus-Outpatient Hospital',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'20',
            'name' =>'Urgent Care Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'21',
            'name' =>'Inpatient Hospital',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'22',
            'name' =>'On Campus-Outpatient Hospital',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'23',
            'name' =>'Emergency Room-Hospital',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'24',
            'name' =>'Ambulatory Surgical Center',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'25',
            'name' =>'Birthing Center',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'26',
            'name' =>'Military Treatment Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'31',
            'name' =>'Skilled Nursing Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>32,
            'name' =>'Nursing Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'33',
            'name' =>'Custodial Care Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'34',
            'name' =>'Hospice',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'41',
            'name' =>'Ambulance-Land',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'42',
            'name' =>"Ambulance - Air or Water",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'49',
            'name' =>'Independent Clinic',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'50',
            'name' =>'Federally Qualified Health Center',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'51',
            'name' =>'Inpatient Psychiatric Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'52',
            'name' =>'Psychiatric Facility-Partial Hospitalization',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'53',
            'name' =>'Community Mental Health Center',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'54',
            'name' =>'Intermediate Care Facility/Mentally Retarded',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'55',
            'name' =>'Residential Substance Abuse Treatment Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'56',
            'name' =>'Psychiatric Residential Treatment Center',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'57',
            'name' =>'Non-residential Substance Abuse Treatment Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'60',
            'name' =>'Mass Immunization Center',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'61',
            'name' =>'Comprehensive Inpatient Rehabilitation Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'62',
            'name' =>'Comprehensive Outpatient Rehabilitation Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'65',
            'name' =>'End-Stage Renal Disease Treatment Facility',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'71',
            'name' =>'Public Health Clinic',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'72',
            'name' =>'Rural Health Clinic',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'81',
            'name' =>'Independent Laboratory',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'service_code' =>'99',
            'name' =>'Other Place of Service',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
    ]);
    }
    }
