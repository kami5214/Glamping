<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicio;


class ServicioController extends Controller
{
    function _construct() {
        $this->middleware('can:ver-servicio, crear-servicio, editar-servicio, borrar-servicio', ['only'=>['index']]);
        $this->middleware('can:crear-servicio', ['only'=>['create','store']]);
        $this->middleware('can:editar-servicio', ['only'=>['edit','update']]);
        $this->middleware('can:borrar-servicio', ['only'=>['destroy']]);
    }
    // Listar servicios
    public function index()
    {

        $servicios=servicio::paginate(300);
        return view('servicios.index', compact('servicios'));
    }

    // Formulario para registrar un servicio
    public function create()
    {
        return view('servicios.create');
    }

    // Almacenar un nuevo servicio
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'ser_nombre' => ['required','unique:servicios' ],
            'ser_estado' => 'required|string',
            'ser_precio' => 'required|integer',
            'ser_cantidad' => 'required|integer',
        ]);


        // Crear una nueva instancia de Domo con los datos validados
        $domo = new servicio([
            'ser_nombre' => $validatedData['ser_nombre'],
            'ser_estado' => $validatedData['ser_estado'],
            'ser_precio' => $validatedData['ser_precio'],
            'ser_cantidad' => $validatedData['ser_cantidad'],
            // Asignar otros campos aquí
        ]);

        // Guardar el domo en la base de datos
        $domo->save();

        // Redireccionar a la vista de lista de domos o a donde desees
        return redirect()->route('servicios.index');

        
    }

    // Editar un servicio
    public function edit(servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    // Actualizar un domo
    public function update(Request $request, servicio $servicio)
    {
        request()->validate([
            'ser_nombre' => 'required',
            'ser_estado' => 'required',
            'ser_precio' => 'required',
            'ser_cantidad' => 'required',
        ]);
        $servicio->update($request->all());
        return redirect()->route('servicios.index');
    }

  /**
     * Remove the specified resource from storage.
     */

    public function destroy(servicio $servicio)
    {
        try {
            // Intenta eliminar el domo
            $servicio->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Si ocurre una excepción debido a una restricción de clave externa, captura el error
            // y redirecciona con un mensaje de error
            return redirect()->route('servicios.index')->with('error', 'No se pueden eliminar servicios asociados a reservas.');
        }
        // Si la eliminación se realizó con éxito, redirecciona a la vista de lista de domos
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminada con éxito.');
    }
}
