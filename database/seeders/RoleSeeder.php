<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [ 'SubAdmin','Admin', 'Reporter', 'Biller', 'Worker',  'Editor'];
        foreach ($roles as $role) {
            Role::create(['name' => $role,  'guard_name' =>'web']);
        }
    }
}
