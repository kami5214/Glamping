<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregamos
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    function _construct() {
        $this->middleware('can:ver-usuario, crear-usuario, editar-usuario, borrar-usuario', ['only'=>['index']]);
        $this->middleware('can:crear-usuario', ['only'=>['create','store']]);
        $this->middleware('can:editar-usuario', ['only'=>['edit','update']]);
        $this->middleware('can:borrar-usuario', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios=user::paginate(300); /* order by*/
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::pluck('name', 'name')->all();
        return view ('usuarios.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)  
    {
        $this->validate($request, [
            'usu_cedula'=>['required','unique:users' ],
            'name'=> 'required',
            'usu_apellido'=> 'required',
            'usu_celular'=> 'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|same:confirm-password', //NYAAAAA
            'estado'=>'required'
        ]);
        $input=$request->all(); /* AQUII!!!!!  */
        $input['password']= Hash::make($input['password']);

        $user=User::create($input);

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);
        $roles=Role::pluck('name','name')->all();
        $userRoles=$user->roles->pluck('name','name')->all();

        return view('usuarios.editar',compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'usu_cedula'=>['required','unique:users' ],
            'name'=> 'required', 
            'usu_apellido'=> 'required', 
            'usu_celular'=> 'required', 
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'nullable|same:confirm-password',
            'estado'=>'required'
        ]);


        $input=$request->all();
        if (!empty($input['password'])) {
            $input['password']=Hash::make($input['password']);
        } else {
            $input=Arr::except($input, ['password']);
        }
        
        $user=User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();




        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        try {
            // Intenta eliminar el domo
            $usuario->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Si ocurre una excepción debido a una restricción de clave externa, captura el error
            // y redirecciona con un mensaje de error
            return redirect()->route('usuarios.index')->with('error', 'No se pueden eliminar usuarios asociados a reservas.');
        }
        // Si la eliminación se realizó con éxito, redirecciona a la vista de lista de domos
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminada con éxito.');
    }

    // public function home() { $data = $this->model->getDatos(); $this->views->getView($this,"home"); }


    
}
