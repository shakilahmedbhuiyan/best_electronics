<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; // Add this line

class DefaultPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'user-list',
            'user-edit',
            'user-delete',
            'user-role-update',
            'user-password-update',

            'admin-create',
            'admin-edit',
            'admin-delete',
            'dashboard',

            'category-list',
            'category-create',
            'category-update',
            'category-delete',

            'brand-list',
            'brand-create',
            'brand-update',
            'brand-delete',

            'product-list',
            'product-create',
            'product-update',
            'product-delete',

            'slider-list',
            'slider-create',
            'slider-update',
            'slider-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
