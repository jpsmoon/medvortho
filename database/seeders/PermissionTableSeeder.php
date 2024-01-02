<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'patient-list', //patient
            'patient-create',
            'patient-edit',
            'patient-delete',
            'injury-list', //injury
            'injury-create',
            'injury-edit',
            'injury-delete',
            'bill-list', //bill
            'bill-create',
            'bill-edit',
            'bill-delete',
            'schedular-list', //schedular
            'schedular-create',
            'schedular-edit',
            'schedular-delete',
            'billing-provider-list', //billingprovider
            'billing-provider-create',
            'billing-provider-edit',
            'billing-provider-delete',

            'rendering-provider-list', //renderingprovider
            'rendering-provider-create',
            'rendering-provider-edit',
            'rendering-provider-delete',

            'billing-provider-places-of-service-list', //billing-provider-places-of-service
            'billing-provider-places-of-service-create',
            'billing-provider-places-of-service-edit',
            'billing-provider-places-of-service-delete',

            'billing-provider-charge-list', //billing-provider-charge
            'billing-provider-charge-create',
            'billing-provider-charge-edit',
            'billing-provider-charge-delete',

            'billing-provider-rendering-refering-list', //billing-provider-practice-charge
            'billing-provider-rendering-refering-create',
            'billing-provider-rendering-refering-edit',
            'billing-provider-rendering-refering-delete',

            'billing-provider-bill-task-preferences-list', //billing-provider-bill-task-preferences
            'billing-provider-bill-task-preferences-create',
            'billing-provider-bill-task-preferences-edit',
            'billing-provider-bill-task-preferences-delete',

            'billing-provider-documents-list', //billing-provider-documents
            'billing-provider-documents-create',
            'billing-provider-documents-edit',
            'billing-provider-documents-delete',

         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
