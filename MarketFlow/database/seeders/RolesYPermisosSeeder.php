<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Arreglo que contiene la lista de permisos
        $permisos = [
            // Permisos para direcciones
            'ver direcciones',
            'crear direcciones',
            'editar direcciones',
            'eliminar direcciones',

            // Permisos para productos
            'ver productos',
            'crear productos',
            'editar productos',
            'eliminar productos',

            // Permisos para usuarios
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',

            // Permisos para categorias
            'ver categoria',
            'crear categoria',
            'editar categoria',
            'eliminar categoria',

            // Permisos para carrito
            'ver carrito',
            'crear carrito',
            'editar carrito',
            'elminar carrito'
        ];

        // Creamos los permisos del arreglo con un ciclo
        foreach ($permisos as $permiso)
        {
            Permission::create(['name' => $permiso]);
        }

        // Creamos los roles
        $rolComprador = Role::firstOrCreate(['name' => 'comprador']);
        $rolVendedor = Role::firstOrCreate(['name' => 'vendedor']);
        $rolAdmin = Role::firstOrCreate(['name' => 'admin']);

        // Le asignamos roles al comprador
        $rolComprador->syncPermissions([
            'ver direcciones',
            'crear direcciones',
            'editar direcciones',
            'eliminar direcciones'
        ]);

    }
}
