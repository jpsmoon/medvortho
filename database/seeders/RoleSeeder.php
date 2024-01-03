<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $permissions = Permission::pluck('id','id')->all();
        $roles = [ 'GlobalAdmin', 'SubAdmin','Admin', 'Reporter', 'Biller', 'Worker',  'Editor'];
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName,  'guard_name' =>'web']); 
        }
        $role = Role::find(1);
        $role->syncPermissions($permissions);
    }
}
