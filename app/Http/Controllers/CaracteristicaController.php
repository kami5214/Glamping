<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\caracteristica;




class CaracteristicaController extends Controller
{
     function __construct() {
        $this->middleware('can:ver-caracteristica, crear-caracteristica, editar-caracteristica, borrar-caracteristica', ['only'=>['index']]);
        $this->middleware('can:crear-caracteristica', ['only'=>['create','store']]);
        $this->middleware('can:editar-caracteristica', ['only'=>['edit','update']]);
        $this->middleware('can:borrar-caracteristica', ['only'=>['destroy']]);
     
    }
    public function index()
    {
        $caracteristicas=caracteristica::paginate(300);
        return view('caracteristicas.index', compact('caracteristicas')); /*heredar para visualizar*/
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caracteristicas.crear');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'car_estado'=>'required',
            'car_descripcion'=>'required',
            'car_nombre'=>['required','unique:caracteristicas'],   
            'car_precio'=>'required',
        ]);
        caracteristica::create($request->all());
        return redirect()->route('caracteristicas.index');
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
    public function edit(caracteristica $caracteristica)
    {
        return view('caracteristicas.editar', compact('caracteristica'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, caracteristica $caracteristica)
    {
        request()->validate([
            'car_estado'=>'required',
            'car_descripcion'=>'required',
            'car_nombre'=>'required',
            'car_precio'=>'required',


        ]);
        $caracteristica->update($request->all());
        return redirect()->route('caracteristicas.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(caracteristica $caracteristica)
    {
        try {
            // Intenta eliminar el domo
            $caracteristica->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Si ocurre una excepción debido a una restricción de clave externa, captura el error
            // y redirecciona con un mensaje de error
            return redirect()->route('caracteristicas.index')->with('error', 'No se pueden eliminar caracteristicas asociadas a domos.');
        }
   
        // Si la eliminación se realizó con éxito, redirecciona a la vista de lista de domos
        return redirect()->route('caracteristicas.index')->with('success', 'Caracteristica eliminada con éxito.');
        //$caracteristica->delete();
        //return redirect()->route('caracteristicas.index');
    }
   
}


