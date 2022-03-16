<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Encargado']);

        Permission::create(['name'=>'admin.home'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'admin.users.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.update'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'encargado.software.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name'=>'encargado.software.edit'])->syncRoles([$role1,$role3]);
        Permission::create(['name'=>'encargado.software.update'])->syncRoles([$role1,$role3]);
        User::create([
            'name'=>'David Maturana',
            'email'=>'davi@gmail.com',
            'password'=>bcrypt('1234')
        ])->assignRole('SuperAdmin');
        User::create([
            'name'=>'Luis Factor',
            'email'=>'luis@gmail.com',
            'password'=>bcrypt('1234')
        ])->assignRole('SuperAdmin');
        User::create([
            'name'=>'Thalia Herrera',
            'email'=>'thalia@gmail.com',
            'password'=>bcrypt('1234')
        ])->assignRole('SuperAdmin');
        // \App\Models\User::factory(10)->create();
    }
}
