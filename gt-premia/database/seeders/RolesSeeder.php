<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Criar roles
        $admin = Role::create(['name' => 'admin']);
        $rh = Role::create(['name' => 'rh']);
        $colaborador = Role::create(['name' => 'colaborador']);
        

        // Criar permissões para premios
        Permission::create(['name' => 'criar premios']);
        Permission::create(['name' => 'editar premios']);
        Permission::create(['name' => 'deletar premios']);
        Permission::create(['name' => 'visualizar premios']);

        //criar permissões para usuários
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'deletar usuarios']);
        Permission::create(['name' => 'visualizar usuarios']);
        Permission::create(['name' => 'criar usuarios']);

        //criar permissões para carteira
        Permission::create(['name' => 'editar carteira']);
        Permission::create(['name' => 'deletar carteira']);
        Permission::create(['name' => 'visualizar carteira']);
        Permission::create(['name' => 'criar carteira']);

        //criar permissões para solicitação de valores
        Permission::create(['name' => 'editar valores']);
        Permission::create(['name' => 'deletar valores']);
        Permission::create(['name' => 'visualizar valores']);
        Permission::create(['name' => 'criar valores']);

        // Atribuir permissões às roles
        $admin->givePermissionTo(Permission::all());
        $rh->givePermissionTo(permission::all());
        $colaborador->givePermissionTo(['visualizar premios','visualizar carteira']);
    }
}

