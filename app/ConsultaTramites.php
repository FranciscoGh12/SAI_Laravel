<?php

namespace SAI;

use Illuminate\Database\Eloquent\Model;

class ConsultaTramites extends Model
{
    protected $table= 'tlv_1821_tr';

    protected $fillable = ['idarea','status','idtipoTramite','ultimaActualizacion'];

    public function scopeTipo($query, $tipoTramite)
    {
        if ($tipoTramite) {
            $query->where('idtipoTramite', "=", "$tipoTramite");
        }
    }

    public function scopeEstatus($query, $status)
    {
        if ($status) {
            $query->where('status', "LIKE", "$status");
        }
    }
}
