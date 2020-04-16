<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;

use Dnetix\Redirection\PlacetoPay;



class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        //realizar una lista por busqueda
        if ($buscar == '') {
             $pagos = Pago::orderBy('id', 'desc')->paginate(3);
        } else {
             $pagos = Pago::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }

        //paginacion
        return [
            'pagination' => [
                'total'        =>  $pagos->total(),
                'current_page' =>  $pagos->currentPage(),
                'per_page'     =>  $pagos->perPage(),
                'last_page'    =>  $pagos->lastPage(),
                'from'         =>  $pagos->firstItem(),
                'to'           =>  $pagos->lastItem(),
            ],
            'vehiculos' =>  $pagos
        ];
    }

    //obtener las categorias que estan activas
    public function selectVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $pagos = Pago::where('condicion', '=', '1')
            ->select('id', 'placa')->orderBy('placa', 'asc')->get();
        return ['vehiculo' =>  $pagos];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
         $pagos = new Pago();


      
         $pagos->name = $request->nombre;
         $pagos->email = $request->correo;
         $pagos->mobile = $request->telefono;
         $pagos->status = '1';
       


        $seed = date('c');
        $secretKey = '024h1IlD';


        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        

        $pagos->save();

        return [
            'auth' => [
                'login' => env('PLACETOPAY_API_SERVICE_LOGIN'),
                'tranKey' => $tranKey,
                'nonce' => $nonceBase64,
                'seed' => $seed
            ]
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $pagos = Pago::findOrFail($request->id);
         $pagos->name = $request->name;
         $pagos->mobile = $request->mobile;
         $pagos->email = $request->email;
         $pagos->status = '1';
         $pagos->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $pagos = Pago::findOrFail($request->id);
         $pagos->condicion = '0';
         $pagos->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         $pagos = Pago::findOrFail($request->id);
         $pagos->condicion = '1';
         $pagos->save();
    }
}
