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
        $role1 = Role::create(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Guardia']);
        $role4 = Role::create(['name' => 'Vecino']);
        $role5 = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'user_create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user_edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user_destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user_idex'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);

        Permission::create(['name' => 'visita_create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'visita_edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'visita_destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'visita_idex'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'condomino_create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'condomino_edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'condomino_destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'condomino_idex'])->syncRoles([$role1, $role2, $role3, $role4]);
    }
}
