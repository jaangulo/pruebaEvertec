<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable =[
        'idvehiculo','identifiacion','nombre','apellidos','casado','ingresos','vehhiculoactual'
    ];
    //referencia al modelo categoria
    public function vehiculo(){
        return $this->belongsTo('App\Vehiculo');
    }
}
