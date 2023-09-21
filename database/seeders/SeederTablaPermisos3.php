<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos=[ 
            //tabla-metodos
            'ver-metodo',
            'crear-metodo',
            'editar-metodo',
            'borrar-metodo',
       
           ];
   foreach($permisos as $permiso){
       Permission::create([ 'name'=>$permiso]);
   }
    }
}
