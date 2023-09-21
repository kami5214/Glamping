<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reserva;
use App\Models\User;
use App\Models\cliente;
use App\Models\Domo;
use App\Models\Servicio;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB as FacadesDB;

class ReservaController extends Controller
{
    function __construct() {
        /*$this->middleware('permission:ver-reserva, crear-reserva, editar-reserva, borrar-reserva', ['only'=>['index']]);
        $this->middleware('permission:crear-reserva', ['only'=>['create','store']]);
        $this->middleware('permission:editar-reserva', ['only'=>['edit','update']]);
        $this->middleware('permission:borrar-reserva', ['only'=>['destroy']]);*/
        $this->middleware('can:ver-reserva,crear-reserva,editar-reserva,borrar-reserva', ['only' => ['index']]);
        $this->middleware('can:crear-reserva', ['only' => ['create', 'store']]);
        $this->middleware('can:editar-reserva', ['only' => ['edit', 'update']]);
        $this->middleware('can:borrar-reserva', ['only' => ['destroy']]);
    }
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas=reserva::paginate(300);
        /*$reservas=reserva::all();*/
        foreach ($reservas as $reserva) {
            $reserva->serviciosSeleccionados = $reserva->servicios->pluck('ser_nombre')->toArray();
        }    
        return view('reservas.index', compact('reservas')); //Heredar para visualizar 
    }

    

public function generatePDF($reservaId )
{
    // Obtener la reserva
    $reserva = Reserva::findOrFail($reservaId);

    // Obtener el detalle del domo asociado a la reserva
    $domo = $reserva->domo;

    // Obtener los servicios asociados a la reserva
    $servicios = $reserva->servicios;

    // Generar el PDF y pasar los datos a la vista de PDF
    $pdf = PDF::loadView('reservas.pdf', compact('reserva', 'domo', 'servicios'));

    // Descargar o mostrar el PDF

    return $pdf->stream('archivo.pdf');
}
/*
    public function generarPDF($id)
    {
        $reserva = Reserva::find($id);
        $pdf = PDF::loadView('pdf.reserva', compact('reserva'));
        return $pdf->download('reserva.pdf');
    }

     */
    public function create()
    {
        $usuarioAutenticado = auth()->user();
        $usuarios = User::all();
        $clientes = cliente::all();
        $domos = Domo::all();
        $servicios = Servicio::all();

        return view('reservas.crear', compact('usuarios','usuarioAutenticado','clientes', 'domos','servicios'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([ 
            'res_fecha_ini'=> ['required', 'date', 'after_or_equal:today'],
            'res_fecha_fin' => ['required', 'date', 'after_or_equal:res_fecha_ini'],
            //  'res_fecha_registro'=>'required',
            'res_cantidad_per'=>'required',
            'res_descuento'=>'required',
            //'res_estado'=>'required',
            'res_total'=>'required',
            'usu_cedula'=>'required',
            'cli_cedula'=>'required',
            'dom_codigo'=>'required',
        ]);

        $reserva = new Reserva([
            'res_fecha_ini' => $request->input('res_fecha_ini'),
            'res_fecha_fin' => $request->input('res_fecha_fin'),
         //   'res_fecha_registro' => $request->input('res_fecha_registro'),
            'res_cantidad_per' => $request->input('res_cantidad_per'),
            'res_descuento' => $request->input('res_descuento'),
           // 'res_estado' => $request->input('res_estado'),
            'res_total' => $request->input('res_total'),

        ]);

        $reserva->res_fecha_registro = Carbon::now();

        $reserva->usuario()->associate(User::find($request->input('usu_cedula')));
        $reserva->cliente()->associate(Cliente::find($request->input('cli_cedula')));
    $reserva->domo()->associate(Domo::find($request->input('dom_codigo')));
  //  $reserva->servicios()->sync($request->input('ser_codigo'));
  //  $serviciosSeleccionados = $request->input('servicios');

    $customRules = [
        'res_cantidad_per' => [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($request) {
                $domo = Domo::find($request->input('dom_codigo'));
                if ($domo && $value > $domo->dom_capacidad) {
                    $fail("La cantidad de personas no puede ser mayor que la capacidad del domo.");
                }
            },
        ],
        // Otras reglas de validación aquí
    ];

    // Crea un validador personalizado
    $validator = Validator::make($request->all(), $customRules);

    // Realiza la validación
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

//VALIDACION DOMOS

// Definir regla de validación personalizada para 'dom_codigo'
$validator = Validator::make($request->all(), [
    'dom_codigo' => [
        'required',
        function ($attribute, $value, $fail) use ($request) {
            $res_fecha_inicio = $request->input('res_fecha_ini');
            $res_fecha_fin = $request->input('res_fecha_fin');

            // Realizar la consulta para verificar la disponibilidad del domo
            $reservas = FacadesDB::table('reservas')
                ->where('dom_codigo', $value)
                ->where(function ($query) use ($res_fecha_inicio, $res_fecha_fin) {
                    $query->whereBetween('res_fecha_ini', [$res_fecha_inicio, $res_fecha_fin])
                        ->orWhereBetween('res_fecha_fin', [$res_fecha_inicio, $res_fecha_fin])
                        ->orWhere(function ($query) use ($res_fecha_inicio, $res_fecha_fin) {
                            $query->where('res_fecha_ini', '<=', $res_fecha_inicio)
                                ->where('res_fecha_fin', '>=', $res_fecha_fin);
                        });
                })
                ->count();

            if ($reservas > 0) {
                $fail("El domo seleccionado no está disponible en el rango de fechas especificado.");
            }
        },
    ],
    // Otras reglas de validación...
]);

if ($validator->fails()) {
    return back()
        ->withErrors($validator)
        ->withInput();
}

$validator = Validator::make($request->all(), [
    'res_descuento' => [
        'required',
        'numeric',
        function ($attribute, $value, $fail) use ($request) {
            if ($value > $request->input('res_total')) {
                $fail("El campo $attribute no puede ser mayor que el campo res_total.");
            }
        },
    ],
]);
    // Comprueba si la validación falla
    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

// Otras reglas de validación...

    // Guardar la reserva en la base de datos
    $reserva->save();    
    //esta siguiente linea tiene que se despues del sav    
    $reserva->servicios()->attach($request->input('servicios'));

        //reserva::create($request->all());
        return redirect()->route('reservas.index');
    }


    public function show($id)
    {
        /*$usuarios = User::all();
        $clientes = cliente::all();
        $domos = Domo::all();
        $servicios = Servicio::all();*/

        $reserva=reserva::find($id);
        return view('reservas.mostrar', compact('reserva'));
    }


    public function edit(reserva $reserva)
    {
        
        $usuarios = User::all();
    $clientes = Cliente::all();
    $domos = Domo::all();
        $servicios = Servicio::all();

        return view('reservas.editar', compact('reserva', 'usuarios','clientes', 'domos','servicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reserva $reserva)
    {
        request()->validate([ 
            'res_fecha_ini'=> ['required', 'date', 'after_or_equal:today'],
            'res_fecha_fin' => ['required', 'date', 'after_or_equal:res_fecha_ini'],          //  'res_fecha_registro'=>'required',
            'res_cantidad_per'=>'required',
            'res_descuento'=>'required',
            //'res_estado'=>'required',
            'res_total'=>'required',
            'usu_cedula'=>'required',
            'cli_cedula'=>'required',
            'dom_codigo'=>'required',
        ]);
        $serviciosSeleccionados = $request->input('serviciosSeleccionados');
        $reserva->servicios()->sync($serviciosSeleccionados);

        $customRules = [
            'res_cantidad_per' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $domo = Domo::find($request->input('dom_codigo'));
                    if ($domo && $value > $domo->dom_capacidad) {
                        $fail("La cantidad de personas no puede ser mayor que la capacidad del domo.");
                    }
                },
            ],
            // Otras reglas de validación aquí
        ];
    
        // Crea un validador personalizado
        $validator = Validator::make($request->all(), $customRules);
    
        // Realiza la validación
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

   // Verificar si la fecha de inicio es la fecha actual o posterior
   if (Carbon::now()->lte($reserva->res_fecha_ini) && Carbon::now()->lt($reserva->res_fecha_fin)) {
    $reserva->res_estado = 'en curso';
} elseif (Carbon::now()->gte($reserva->res_fecha_fin)) {
    $reserva->res_estado = 'completada';
}

        $reserva->update($request->all());
        return redirect()->route('reservas.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reserva $reserva)
    {
        try {
            // Intenta eliminar el domo
            $reserva->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Si ocurre una excepción debido a una restricción de clave externa, captura el error
            // y redirecciona con un mensaje de error
            return redirect()->route('reservas.index')->with('error', 'No se pueden eliminar reservas asociadas a servicios.');
        }
        // Si la eliminación se realizó con éxito, redirecciona a la vista de lista de domos
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada con éxito.');
    }


    public function addService(Request $request, $id)
    {
        // Lógica para añadir una característica al domo
         // Valida que el ID del domo exista en la base de datos
         $reserva = reserva::findOrFail($id);
         // Valida que el ID de la característica exista en la base de datos
         $servicioId = $request->input('ser_codigo');
         $servicio = servicio::findOrFail($servicioId);
         // Asigna la característica al domo
         $reserva->servicios()->attach($servicio);
         // Redirecciona a la vista de detalles del domo o a donde desees
         return redirect()->route('reservas.crear', ['reserva' => $reserva]);
    }

    public function removeService($id, $serviceId)
    {
 $reserva = reserva::findOrFail($id);
    $reserva->servicios()->detach($serviceId);
    return redirect()->route('reservas.editar', ['reserva' => $reserva]);
    }

    public function guardarServicios(Request $request)
    {
        $reserva = reserva::find($request->res_codigo);
        // Obtén las características seleccionadas desde la solicitud
        $serviciosSeleccionados = $request->servicios;
        // Actualiza las características asociadas al domo
        $reserva->servicios()->sync($serviciosSeleccionados);
        return response()->json(['message' => 'Servicios guardados con éxito']);
    
    }

}
