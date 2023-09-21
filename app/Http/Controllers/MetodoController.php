<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\metodo;

class MetodoController extends Controller
{
    function __construct() {
        $this->middleware('can:ver-metodo, crear-metodo, editar-metodo, borrar-metodo', ['only'=>['index']]);
        $this->middleware('can:crear-metodo', ['only'=>['create','store']]);
        $this->middleware('can:editar-metodo', ['only'=>['edit','update']]);
        $this->middleware('can:borrar-metodo', ['only'=>['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodos=metodo::paginate(300);
        /*$reservas=reserva::all();*/
        return view('metodos.index', compact('metodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metodos.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([ 
            'met_nombre'=>['required','unique:metodos' ],

        ]);
        metodo::create($request->all());
        return redirect()->route('metodos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $met_codigo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(metodo $metodo)
    {
        return view('metodos.editar', compact('metodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, metodo $metodo)
    {
        request()->validate([ 
            'met_nombre'=>'required',


        ]);
        $metodo->update($request->all());
        return redirect()->route('metodos.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(metodo $metodo)
    {
        $metodo->delete();
        return redirect()->route('metodos.index');
    }
}
