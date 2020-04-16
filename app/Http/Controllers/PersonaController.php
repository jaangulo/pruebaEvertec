<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Pago;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas  = Pago::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $personas = Persona::join(' pagos','personas.idvehiculo','=',' pagos.id')
            ->select('personas.id','personas.idvehiculo','personas.identifiacion','personas.nombre',' pagos.placa as placa_vehiculo','personas.apellidos','personas.casado','personas.ingresos','personas.condicion','personas.vehhiculoactual')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = new Persona();
        $persona->idvehiculo = $request->idvehiculo;
        $persona->identifiacion = $request->identifiacion;
        $persona->apellidos = $request->apellidos;
        $persona->nombre = $request->nombre;
        $persona->casado = $request->casado;
        $persona->ingresos = $request->ingresos;
        $persona->vehhiculoactual = $request->vehhiculoactual;
       
        $persona->condicion = '1';
        $persona->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->idvehiculo = $request->idvehiculo;
        $persona->identifiacion = $request->identifiacion;
        $persona->apellidos = $request->apellidos;
        $persona->nombre = $request->nombre;
        $persona->casado = $request->casado;
        $persona->ingresos = $request->ingresos;
        $persona->vehhiculoactual = $request->vehhiculoactual;
        $persona->condicion = '1';
        $persona->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->condicion = '0';
        $persona->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->condicion = '1';
        $persona->save();
    }

}

