<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call( DefaultPermissionsSeeder::class);
        $user = User::create([
            'name' => 'System Admin',
            'email' => 'admin@retrievalit.xyz',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'id_no' => '1234567890',
        ]);

        $role = Role::create(['name' => 'super-admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
