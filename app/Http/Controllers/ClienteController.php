<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;

class ClienteController extends Controller
{
    function __construct() {
        $this->middleware('can:ver-cliente, crear-cliente, editar-cliente, borrar-cliente', ['only'=>['index']]);
        $this->middleware('can:crear-cliente', ['only'=>['create','store']]);
        $this->middleware('can:editar-cliente', ['only'=>['edit','update']]);
        $this->middleware('can:borrar-cliente', ['only'=>['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes=cliente::paginate(300);
        /*$reservas=reserva::all();*/
        return view('clientes.index', compact('clientes')); //Heredar para visualizar 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([ 
            'id',
            'cli_cedula'=>['required','unique:clientes' ],
            'cli_nombre'=>'required',
            'cli_apellido'=>'required',
            'cli_correo'=>'required',
            'cli_celular'=>'required',
            'cli_ciudad'=>'required',
            'cli_estado'=>'required',
        ]);
        cliente::create($request->all());
        return redirect()->route('clientes.index');
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
    public function edit(cliente $cliente)
    {
        return view('clientes.editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        request()->validate([ 
            'id',
            'cli_cedula'=>['required'],
            'cli_nombre'=>'required',
            'cli_apellido'=>'required',
            'cli_correo'=>'required',
            'cli_celular'=>'required',
            'cli_ciudad'=>'required',
            'cli_estado'=>'required',

        ]);
        $cliente->update($request->all());
        return redirect()->route('clientes.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
