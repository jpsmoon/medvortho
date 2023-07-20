<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('countries')->insert([
            [
                'country_name' => 'India',
                'is_active' => 1,
            ],
            [
                'country_name' => 'United States',
                'is_active' => 1,
            ],
        ]);
    }
}
