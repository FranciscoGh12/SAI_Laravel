<?php

namespace SAI;

use Illuminate\Database\Eloquent\Model;
use DB;

class ConsultaPersonal extends Model
{
    protected  $table= 'tlv_1821_u';

    protected $fillable =[
        'status',
        'idarea',
        'idRol',
        'nombre',
        'paterno',
        'materno'
    ];

    public function scopeNombre($query, $nombre_personal){
        if(trim($nombre_personal)!=""){
            $query->where(DB::raw("CONCAT(nombre,' ',paterno)"), "LIKE", "%$nombre_personal%");
        }
    }

    public function scopeEstatus($query, $status){
        if($status){
            $query->where('status', "LIKE", "$status");
        }
    }

    public function scopeRol($query, $rol_user)
    {
        if($rol_user){
            $query->where('idRol', "LIKE", "$rol_user");
        }
    }
}
