<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReportTypeTableSeeder extends Seeder
{
/**
 * Run the database seeds.
 *
 * @return void
 */
public function run()
{
//
        \DB::table('report_type')->insert([
        [
        'code' => 'J1',
        'report_name' =>"Doctor's First Report (DLSR 5021)",
        'status' => 1
        ],

        [
        'code' => 'J2',
        'report_name' =>"Supplemental Medical Report (BRs)",
        'status' => 1
        ],
        [
        'code' => 'J3',
        'report_name' =>"Medical Permanent Impairment Report",
        'status' => 1
        ],

        [
        'code' => 'J4',
        'report_name' =>"Med-Legal Report",
        'status' => 1
        ],
        [
        'code' => 'J5',
        'report_name' =>"Vocational Report",
        'status' => 1
        ], 
        [
        'code' => 'J6',
        'report_name' =>"Work Status Report",
        'status' => 1
        ], 
        [
        'code' => 'J7',
        'report_name' =>"Consultation Report",
        'status' => 1
        ],
        [
        'code' => 'J8',
        'report_name' =>"Permanent Disability Report",
        'status' => 1
        ],
        [
        'code' => 'J9',
        'report_name' =>"Itemized Statement",
        'status' => 1
        ], 
        [
        'code' => '03',
        'report_name' =>"Justifying Treatment Beyond Utilization Guidelines",
        'status' => 1
        ],
        [
        'code' => '04',
        'report_name' =>"Drugs Administered",
        'status' => 1
        ],

        [
        'code' => '05',
        'report_name' =>"Treatment Diagnosis",
        'status' => 1
        ],
        [
        'code' => '06',
        'report_name' =>"Initial Assessment",
        'status' => 1
        ],
        [
        'code' => '07',
        'report_name' =>"Plan of Treatment",
        'status' => 1
        ],
        [
        'code' => '08',
        'report_name' =>"Plan of Treatment",
        'status' => 1
        ],
        [
        'code' => '09',
        'report_name' =>"PR2 (Progress Report)",
        'status' => 1
        ],
        [
        'code' => '10',
        'report_name' =>"Continued Treatment",
        'status' => 1
        ],
        [
        'code' => '11',
        'report_name' =>"Chemical Analysis",
        'status' => 1
        ],
        [
        'code' => '13',
        'report_name' =>"Certified Test Report",
        'status' => 1
        ],
        [
        'code' => '15',
        'report_name' =>"Justification for Admission",
        'status' => 1
        ],
        [
        'code' => '21',
        'report_name' =>"Recovery Plan",
        'status' => 1
        ],
        [
        'code' => 'A3',
        'report_name' =>"Allergies/Sensitivities Document",
        'status' => 1
        ],
        [
        'code' => 'A4',
        'report_name' =>"Autopsy Report",
        'status' => 1
        ],
        [
        'code' => 'AM',
        'report_name' =>"Ambulance Certification",
        'status' => 1
        ],
        [
        'code' => 'AS',
        'report_name' =>"Admission Summary",
        'status' => 1
        ],
        [
        'code' => 'B2',
        'report_name' =>"Prescription",
        'status' => 1
        ],
        [
        'code' => 'B3',
        'report_name' =>"Physician Order",
        'status' => 1
        ],
        [
        'code' => 'B4',
        'report_name' =>"Referral Form",
        'status' => 1
        ],
        [
        'code' => 'BR',
        'report_name' =>"Benchmark Testing Results",
        'status' => 1
        ],
        [
        'code' => 'BS',
        'report_name' =>"Baseline",
        'status' => 1
        ],
        [
        'code' => 'BT',
        'report_name' =>"Blanket Test Results",
        'status' => 1
        ],
        [
        'code' => 'CB',
        'report_name' =>"Chiropractic Justification",
        'status' => 1
        ],
        [
        'code' => 'CK',
        'report_name' =>"Canceled Check",
        'status' => 1
        ],
        [
        'code' => 'CT',
        'report_name' =>"Certification",
        'status' => 1
        ],
        [
        'code' => 'D2',
        'report_name' =>"Drug Profile Document",
        'status' => 1
        ],
        [
        'code' => 'DA',
        'report_name' =>"Dental Models",
        'status' => 1
        ],
        [
        'code' => 'DB',
        'report_name' =>"Durable Medical Equipment RX",
        'status' => 1
        ],
        [
        'code' => 'DG',
        'report_name' =>"Diagnostic Report",
        'status' => 1
        ],
        [
        'code' => 'DJ',
        'report_name' =>"Discharge Monitoring Report",
        'status' => 1
        ],
        [
        'code' => 'DS',
        'report_name' =>"Discharge Summary",
        'status' => 1
        ],
        [
        'code' => 'EB',
        'report_name' =>"Explanation of Benefits",
        'status' => 1
        ],
        [
        'code' => 'HC',
        'report_name' =>"Health Clinic Records (HC)",
        'status' => 1
        ],
        [
        'code' => 'HR',
        'report_name' =>"Health Clinic Records (HR)",
        'status' => 1
        ],
        [
        'code' => 'I5',
        'report_name' =>"Immunization Record",
        'status' => 1
        ],
        [
        'code' => 'IR',
        'report_name' =>"State School Immunization Records",
        'status' => 1
        ],
        [
        'code' => 'LA',
        'report_name' =>"Laboratory Results",
        'status' => 1
        ],
        [
        'code' => 'M1',
        'report_name' =>"Medical Record Attachment",
        'status' => 1
        ],
        [
        'code' => 'MT',
        'report_name' =>"Nursing Notes",
        'status' => 1
        ],
        [
        'code' => 'NN',
        'report_name' =>"Minor Deviation Request",
        'status' => 1
        ],
        [
        'code' => 'OB',
        'report_name' =>"Operative Note",
        'status' => 1
        ],
        [
        'code' => 'OC',
        'report_name' =>"Oxygen Content Averaging Report",
        'status' => 1
        ],
        [
        'code' => 'OD',
        'report_name' =>"Orders and Treatments Document",
        'status' => 1
        ],
        [
        'code' => 'OE',
        'report_name' =>"Objective Physical Examination Doc",
        'status' => 1
        ],
        [
        'code' => 'OX',
        'report_name' =>"Oxygen Therapy Certification",
        'status' => 1
        ],
        [
        'code' => 'OZ',
        'report_name' =>"Support Data for Bill",
        'status' => 1
        ],
        [
        'code' => 'P4',
        'report_name' =>"Pathology Report",
        'status' => 1
        ],
        [
        'code' => 'P5',
        'report_name' =>"Patient Medical History Document",
        'status' => 1
        ],
        [
        'code' => 'PE',
        'report_name' =>"Periodontal Charts",
        'status' => 1
        ],
        [
        'code' => 'PN',
        'report_name' =>"Physical Therapy Notes",
        'status' => 1
        ],
        [
        'code' => 'PO',
        'report_name' =>"Prosthetics or Orthotic Certification",
        'status' => 1
        ],
        [
        'code' => 'PQ',
        'report_name' =>"Paramedical Results",
        'status' => 1
        ],
        [
        'code' => 'PY',
        'report_name' =>"Physician's Report",
        'status' => 1
        ],
        [
        'code' => 'PZ',
        'report_name' =>"Physical Therapy Certification",
        'status' => 1
        ],
        [
        'code' => 'RB',
        'report_name' =>"Radiology Films",
        'status' => 1
        ],
        [
        'code' => 'RR',
        'report_name' =>"Radiology Reports",
        'status' => 1
        ],
        [
        'code' => 'RT',
        'report_name' =>"Report of tests and Analysis Report",
        'status' => 1
        ],
        [
        'code' => 'RX',
        'report_name' =>"Renewable Oxygen Content Averaging Report",
        'status' => 1
        ],
        [
        'code' => 'SG',
        'report_name' =>"Symptoms Document",
        'status' => 1
        ],
        [
        'code' => 'V5',
        'report_name' =>"Death Notification",
        'status' => 1
        ],
        [
        'code' => 'XP',
        'report_name' =>"Photographs",
        'status' => 1
        ]
]);
}
}