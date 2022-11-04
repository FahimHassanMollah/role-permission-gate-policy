<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::get();
        Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'he/she can access everything',
            'deletable' => false
        ])->permissions()->sync($permissions->pluck('id'));

        Role::updateOrCreate([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'he/she can only access the assigned permission',
            'deletable' => false
        ]);
    }
}
