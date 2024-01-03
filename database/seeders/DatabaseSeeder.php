<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(BillPlaceServiceSeeder::class);  //Added by priyanka on 24/07/2022
        $this->call( RenderingProversSeeder::class);  //Added by priyanka on 24/07/2022
        $this->call( BillModifierSeeder::class);  //Added by priyanka on 03/08/2022
        $this->call( CountriesSeeder::class);  //Added by priyanka on 07/09/2022
        $this->call( StateSeeder::class);  //Added by priyanka on 07/09/2022
        $this->call( CitySeeder::class);  //Added by priyanka on 07/09/2022
        $this->call( BillPlaceServiceCodeSeeder::class);  //Added by priyanka on 02/24/2023
        $this->call( MasterBillChargesSheetTableSeeder::class);  //Added by priyanka on 03/14/2023
        $this->call( TaskCategoryTableSeeder::class);  //Added by priyanka on 03/17/2023
        $this->call( TaskTableSeeder::class);  //Added by priyanka on 03/17/2023
        $this->call( PermissionTableSeeder::class);  //Added by priyanka on 06/13/2023
        $this->call( RoleSeeder::class);  //Added by priyanka on 05/06/2023
        $this->call( UserRolesSeeder::class);  //Added by priyanka on 05/06/2023 
        $this->call( StatusTableSeeder::class);  //Added by priyanka on 08/02/2023
        $this->call( UserSeeder::class);  //Added by priyanka on 05/06/2023 
        $this->call( ClaimAdministrators::class);  //Added by priyanka on 02/01/2024
        $this->call( ClaimMailAddresses::class);  //Added by priyanka on 02/01/2024
        $this->call( ClaimBillReviews::class);  //Added by priyanka on 02/01/2024
        $this->call( ClaimAuthContacts::class);  //Added by priyanka on 02/01/2024
        
        $this->call( ZipCodesWithStateCity::class);  //Added by priyanka on 02/01/2024

    }
}
