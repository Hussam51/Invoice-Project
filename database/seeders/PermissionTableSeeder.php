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
            'roles',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-user-list',
            'products',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'sections',
            'section-list',
            'section-create',
            'section-edit',
            'section-delete',
            'invoices',
            'invoice-list',
            'invoice-create',
            'invoice-edit',
            'invoice-delete',
            'invoice-export-pdf',
            'invoice-export-excel',
            'invoice-list-report',
            'invoice-details',
            'invoice-archive',
            'invoices-paid',
            'invoices-unpaid',
            'invoices-partially-paid',
            'invoices-archivement',
            'users',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-list-report',
            'reports',
             'setting',
             'notifications'

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
