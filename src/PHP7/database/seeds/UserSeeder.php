<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $board = factory('App\Models\Board')->create();
        $user = User::create([
            'name' => 'Administrador',
            'board_id' => $board->id,
            'email' => 'admin@mail.com',
            'password' => '$2y$10$Q748xkIoXoKaFu1.hjFh6ONjHgpHp864f9akLmk33WlsTIsnTNn76', //B1tchpl3as3@!
        ]);

        $allPermissions = [
            'Super Admin',
            'Crear medida',
            'Ver medida',
            'Borrar medida',
            'Crear peso',
            'Ver peso',
            'Editar peso',
            'Borrar peso',
            'Crear usuario',
            'Editar usuario',
            'Borrar usuario',
            'Ver usuario',
            'Crear rol',
            'Editar rol',
            'Ver rol',
            'Borrar rol',
        ];
        //Super Admin
        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole($role);
        foreach ($allPermissions as $permission) {
            $perm = Permission::create(['name' => $permission]);
            $role->givePermissionTo($perm);
        }

        //Default Role
        $defaultRole = Role::create(['name' => 'Administrator']);
        $permissions = Permission::where('name', '!=', 'Super Admin')->get();
        foreach ($permissions as $permission) {
            $defaultRole->givePermissionTo($permission);
        }
    }
}
