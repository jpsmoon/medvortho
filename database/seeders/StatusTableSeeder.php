<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('statuses')->insert([
            [
                'status_name' => 'Incomplete',
                'slug_name' => 'TASK_INCOMPLETE',
                'display_order'=>'1',
                'description'=>'Incomplete',
                'is_active' => 1,
                'status_type' =>8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Incomplete Bill',
                'slug_name' => 'INCOMPLETE_BILL',
                'display_order'=>'1',
                'description'=>'Incomplete Bill',
                'is_active' => 1,
                'status_type' =>3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Tentative',
                'slug_name' => 'APPOINTMENT_VISIT_STATUS_TENTATIVE',
                'display_order'=>'1',
                'description'=>'Tentative',
                'is_active' => 1,
                'status_type' =>7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Confirmed',
                'slug_name' => 'APPOINTMENT_VISIT_STATUS_CONFIRMED',
                'display_order'=>2,
                'description'=>'Confirmed',
                'is_active' => 1,
                'status_type' =>7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Arrived',
                'slug_name' => 'APPOINTMENT_VISIT_STATUS_ARRIVED',
                'display_order'=>3,
                'description'=>'Arrived',
                'is_active' => 1,
                'status_type' =>7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Cancelled',
                'slug_name' => 'APPOINTMENT_VISIT_STATUS_CANCELLED',
                'display_order'=>4,
                'description'=>'Cancelled',
                'is_active' => 1,
                'status_type' =>7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'No Show',
                'slug_name' => 'APPOINTMENT_VISIT_STATUS_NO_SHOW',
                'display_order'=>5,
                'description'=>'No Show',
                'is_active' => 1,
                'status_type' =>7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Ready to bill',
                'slug_name' => 'APPOINTMENT_BILL_STATUS_READY_TO_BILL',
                'display_order'=>1,
                'description'=>'Ready to bill',
                'is_active' => 1,
                'status_type' =>6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_name' => 'Billed',
                'slug_name' => 'APPOINTMENT_BILL_STATUS_BILLED',
                'display_order'=>2,
                'description'=>'Billed',
                'is_active' => 1,
                'status_type' =>6,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
