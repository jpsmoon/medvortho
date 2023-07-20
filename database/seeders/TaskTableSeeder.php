<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('tasks')->insert([
            //Incomplete
            [
                'task_name' => 'Patient Failed Review',
                'category_id' => 1,
                'slug' => 'PATIENT_FAILED_REVIEW',
                'description' => 'Patient Failed Review',
                'is_active' => 1,
            ],
            [
                'task_name' => 'Injury Failed Review',
                'category_id' => 1,
                'slug' => 'INJURY_FAILED_REVIEW',
                'description' => 'Injury Failed Review',
                'is_active' => 1,
            ],
            [
                'task_name' => 'Bill Failed Review',
                'category_id' => 1,
                'slug' => 'BILL_FAILED_REVIEW',
                'description' => 'Bill Failed Review',
                'is_active' => 1,
            ],
            [
                'task_name' => 'Document Required',
                'category_id' => 1,
                'slug' => 'DOCUMENT_REQUIRED',
                'description' => 'Document Required',
                'is_active' => 1,
            ],
            [
                'task_name' => 'Send Bill',
                'category_id' => 1,
                'slug' => 'SEND_BILL',
                'description' => 'Send Bill',
                'is_active' => 1,
            ],
            [
                'task_name' => 'Send Second Review',
                'category_id' => 1,
                'slug' => 'SEND_SECOND_REVIEW',
                'description' => 'Send Second Review',
                'is_active' => 1,
            ],
            [
                'task_name' => 'Send IBR',
                'category_id' => 1,
                'slug' => 'SEND_IBR',
                'description' => 'Send IBR',
                'is_active' => 1,
            ],
            //Sent
            [
                'task_name' => 'Sent',
                'category_id' => 2,
                'slug' => 'SENT',
                'description' => 'Sent',
                'is_active' => 1,
            ],
            //Accepted
            [
                'task_name' => 'No Response',
                'category_id' => 3,
                'slug' => 'NO_REPONSE',
                'description' => 'No Response',
                'is_active' => 1,
            ],
            [
                'task_name' => 'No Response - Second Review',
                'category_id' => 3,
                'slug' => 'NO_REPONSE_SECOND_REVIEW',
                'description' => 'No Response - Second Review',
                'is_active' => 1,
            ],
            [
                'task_name' => 'No Response - IBR',
                'category_id' => 3,
                'slug' => 'NO_REPONSE_IBR',
                'description' => 'No Response - IBR',
                'is_active' => 1,
            ],
            [
                'task_name' => 'EOR Missing',
                'category_id' => 3,
                'slug' => 'EOR_MISSING',
                'description' => 'EOR Missing',
                'is_active' => 1,
            ],
            
            //Rejected 
            [
                'task_name' => 'Rejected Bill',
                'category_id' => 4,
                'slug' => 'REJECTED_BILL',
                'description' => 'Rejected Bill',
                'is_active' => 1,
            ],
            //Processed 
            [
                'task_name' => 'Payment Received',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],

            [
                'task_name' => 'Denial Received',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],

            [
                'task_name' => 'Payment Received - SBR',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],

            [
                'task_name' => 'Denial Received - SBR',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],

            [
                'task_name' => 'Payment Received - IBR',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],


            [
                'task_name' => 'Denial Received - IBR',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],

            [
                'task_name' => 'Deposit Payment',
                'category_id' => 5,
                'slug' => 'PAYMENT_RECEIVED',
                'description' => 'Payment Received',
                'is_active' => 1,
            ],
            //Closed
            [
                'task_name' => 'Deposit Payment',
                'category_id' => 6,
                'slug' => 'DEPOSIT_PAYMENT',
                'description' => 'Deposit Payment',
                'is_active' => 1,
            ],
            //Lien
            [
                'task_name' => 'Lien Required',
                'category_id' => 7,
                'slug' => 'LIEN_REQUIRED',
                'description' => 'Lien Required',
                'is_active' => 1,
            ],
        ]);
    }
}
