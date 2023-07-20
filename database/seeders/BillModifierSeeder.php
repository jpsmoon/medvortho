<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BillModifier;

class BillModifierSeeder extends Seeder
{
/**
 * Run the database seeds.
 *
 * @return void
 */
public function run()
{
$modiferData = array();
$modiferData1 = array();

for($i = 17; $i < 100; $i ++)
{
    $modiferData[] =
        [
        'name' => $i,
        'description' =>$i,
        'status' => 1,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
         ];

}
$modiferData1 =
    array(
                [
                'name' => 'A1',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A2',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A3',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A4',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A5',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A6',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A7',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A8',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'A9',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AA',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AD',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AE',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AF',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AG',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AH',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AI',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AJ',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AK',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AM',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AP',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AQ',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AR',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AS',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AT',
                'description' => 'A1',
                'status' => 1,
                ],
                [
                'name' => 'AU',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AV',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AW',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'AX',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'BA',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'BL',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'BO',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'BP',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'BR',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'BU',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'CA',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'CB',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'CC',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'CD',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'GG',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'GH',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'GJ',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'JC',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'JD',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'JW',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'K0',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'PL',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'Q0',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'Q1',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'Q2',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'Q3',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SJ',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SK',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SL',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SM',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SN',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SQ',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SS',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'ST',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SU',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'SV',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'XE',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'FY',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'XS',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'XP',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'XU',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'name' => 'FX',
                'description' => 'A1',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]
            );
            $finalData = array_merge($modiferData , $modiferData1);
            foreach($finalData as $key => $val){
                BillModifier::create($val);
            }

    }
}
