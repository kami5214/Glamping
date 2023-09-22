<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Asistente']); 
        
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
         'borrar-cliente',
            //tabla-caracteristicas
            'ver-caracteristica',
            'crear-caracteristica',
            'editar-caracteristica',
            'borrar-caracteristica',
            //tabla-domos
            'ver-domo',
            'crear-domo',
            'editar-domo',
            'borrar-domo',
                  
                        //tabla-servicios
                        'ver-servicio',
                        'crear-servicio',
                        'editar-servicio',
                        'borrar-servicio', 
                                   //tabla-usuarios
                                   'ver-usuario',
                                   'crear-usuario',
                                   'editar-usuario',
                                   'borrar-usuario',
            'ver-metodo',
            'crear-metodo',
            'editar-metodo',
            'borrar-metodo'
                                               
        ];
foreach($permisos as $permiso){
    Permission::create([ 'name'=>$permiso])->syncRoles([$role1]);
}
      User::create(['name' => 'Superadmin', 'email' => 'admin@gmail.com', 'password' => '12345678','usu_apellido' => 'crack','usu_celular' => '3026405997','estado' => 'activo','usu_cedula' => '10052348855']);

     $user = User::find(1);
        $user->assignRole('Administrador');
        
    }
}
