<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'sup.admin@rcm.com',
                'emp_id'=>'1001',
                'phone_no'=>'9100000000',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@rcm.com',
                'emp_id'=>'1002',
                'phone_no'=>'9100000000',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
