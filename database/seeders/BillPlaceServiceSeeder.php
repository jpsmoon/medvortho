<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BillPlaceServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('bill_place_services')->insert([
            [
                'name' => 'Anaheim',
                'status' => 1,
            ],
            [
                'name' => 'Lemon Grove',
                'status' => 1,
            ],
            [
                'name' => 'Long Beach',
                'status' => 1,
            ],
            [
                'name' => 'Los Angeles',
                'status' => 1,
            ],
            [
                'name' => 'Newport Beach',
                'status' => 1,
            ],
            [
                'name' => 'Rancho Cucamonga',
                'status' => 1,
            ],
            [
                'name' => 'San Marcos',
                'status' => 1,
            ],
            [
                'name' => 'Santa Ana',
                'status' => 1,
            ],
            [
                'name' => 'Sherman Oaks',
                'status' => 1,
            ],
            [
                'name' => 'Upland',
                'status' => 1,
            ],
            [
                'name' => 'West Hills',
                'status' => 1,
            ],
            [
                'name' => 'Wilmington',
                'status' => 1,
            ],
        ]);
    }
}
