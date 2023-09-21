<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos=[ 
         //tabla-roles
         'ver-rol',
         'crear-rol',
         'editar-rol',
         'borrar-rol',
         //tabla-reservas
         'ver-reserva',
         'crear-reserva',
         'editar-reserva',
         'borrar-reserva',
         //tabla-clientes
         'ver-cliente',
         'crear-cliente',
         'editar-cliente',
         'borrar-cliente'         
        ];
foreach($permisos as $permiso){
    Permission::create([ 'name'=>$permiso]);
}
    }
}
