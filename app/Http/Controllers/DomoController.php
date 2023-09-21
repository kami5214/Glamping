<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Domo;
use App\Models\caracteristica;


class DomoController extends Controller
{
    function __construct() {
        $this->middleware('can:ver-domo, crear-domo, editar-domo, borrar-domo', ['only'=>['index']]);
        $this->middleware('can:crear-domo', ['only'=>['create','store']]);
        $this->middleware('can:editar-domo', ['only'=>['edit','update']]);
        $this->middleware('can:borrar-domo', ['only'=>['destroy']]);
    }
    // Listar domos
    public function index()
    {
        $domos=domo::paginate(300);
                /*$domos=domo::all();*/
                foreach ($domos as $domo) {
                    $domo->caracteristicasSeleccionadas = $domo->caracteristicas->pluck('car_nombre')->toArray();
                }    
        return view('domos.index', compact('domos'));
    }


    public function create()
    {
        $caracteristicas = caracteristica::all();
        return view('domos.create', compact('caracteristicas'));
    }


    // Almacenar un nuevo domo
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'dom_nombre' => ['required','unique:domos' ],
            'dom_estado' => 'required|string',
            'dom_precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0'],
            'dom_ubicacion' => 'required|string',
            'dom_descripcion' => 'nullable|string',
            'dom_capacidad' => 'required|numeric',
        ]);
            // Obtener las características seleccionadas desde la solicitud
    //$caracteristicasSeleccionadas = $request->input('caracteristicas');
    //$caracteristicasSeleccionadas = $request->caracteristicas;
        // Crear una nueva instancia de Domo con los datos validados
        $domo = new Domo([
            'dom_nombre' => $validatedData['dom_nombre'],
            'dom_estado' => $validatedData['dom_estado'],
            'dom_precio' => $validatedData['dom_precio'],
            'dom_ubicacion' => $validatedData['dom_ubicacion'],
            'dom_descripcion' => $validatedData['dom_descripcion'],
            'dom_capacidad' => $validatedData['dom_capacidad'],
            // Asignar otros campos aquí
        ]);
            // Guardar el domo en la base de datos
    $domo->save();
        // Asociar las características seleccionadas con el domo
        //$domo->caracteristicas()->associate(caracteristica::find($request->input('car_codigo')));
        //$domo->caracteristicas()->sync([$request->input('car_codigo')]);
        $domo->caracteristicas()->attach($request->input('caracteristicas'));
        return redirect()->route('domos.index');
    }


    // Editar un domo
    public function edit(domo $domo)
    {
        $caracteristicas = caracteristica::all();
        return view('domos.edit', compact('domo','caracteristicas'));
    }


    // Actualizar un domo
    public function update(Request $request, domo $domo )
    {
        request()->validate([
            'dom_nombre' => 'required',
            'dom_estado' => 'required',
            'dom_precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0'],
            'dom_ubicacion' => 'required',
            'dom_descripcion' => 'required',
            'dom_capacidad' => 'required',
        ]);
            // Obtén las características seleccionadas del formulario
    $caracteristicasSeleccionadas = $request->input('caracteristicasSeleccionadas');
    // Sincroniza las características del domo con las seleccionadas
    $domo->caracteristicas()->sync($caracteristicasSeleccionadas);
//:(
        $domo->update($request->all());
        return redirect()->route('domos.index');
    }


    public function destroy(domo $domo)
    {
        try {
            // Intenta eliminar el domo
            $domo->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Si ocurre una excepción debido a una restricción de clave externa, captura el error
            // y redirecciona con un mensaje de error
            return redirect()->route('domos.index')->with('error', 'No se pueden eliminar domos asociados a características.');
        }
        // Si la eliminación se realizó con éxito, redirecciona a la vista de lista de domos
        return redirect()->route('domos.index')->with('success', 'Domo eliminado con éxito.');
    }

   
    // Cambiar el estado de un domo
    public function toggleStatus($id)
    {
        // Buscar el domo por su ID en la base de datos
        $domo = Domo::findOrFail($id);
        // Cambiar el estado (por ejemplo, de activo a inactivo o viceversa)
        $domo->activo = !$domo->activo;
        // Guardar el cambio en la base de datos
        $domo->save();
        // Redireccionar a la vista de lista de domos o a donde desees
        return redirect()->route('domos.index');
    }


    // Adicionar una característica al domo
    public function addFeature(Request $request, $id)
    {
        // Lógica para añadir una característica al domo
         // Valida que el ID del domo exista en la base de datos
         $domo = Domo::findOrFail($id);
         // Valida que el ID de la característica exista en la base de datos
         $caracteristicaId = $request->input('car_codigo');
         $caracteristica = caracteristica::findOrFail($caracteristicaId);
         // Asigna la característica al domo
         $domo->caracteristicas()->attach($caracteristica);
         // Redirecciona a la vista de detalles del domo o a donde desees
         return redirect()->route('domos.create', ['domo' => $domo]);
    }


    // Eliminar una característica del domo
    public function removeFeature($id, $featureId)
    {
 $domo = Domo::findOrFail($id);
    $domo->caracteristicas()->detach($featureId);
    return redirect()->route('domos.edit', ['domo' => $domo]);
    }


    // Visualizar las características del domo
    public function showFeatures($id)
    {
        // Lógica para mostrar las características de un domo
    }


    public function guardarCaracteristicas(Request $request)
{
    $domo = Domo::find($request->dom_codigo);
    // Obtén las características seleccionadas desde la solicitud
    $caracteristicasSeleccionadas = $request->caracteristicas;
    // Actualiza las características asociadas al domo
    $domo->caracteristicas()->sync($caracteristicasSeleccionadas);
    return response()->json(['message' => 'Características guardadas con éxito']);

}


}
