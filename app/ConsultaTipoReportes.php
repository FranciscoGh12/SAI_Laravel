<?php

namespace SAI;

use DB;

use Illuminate\Database\Eloquent\Model;

class ConsultaTipoReportes extends Model
{
    protected $table = 'tlv_1821_lr';

    protected $fillable = [
        'idlistaReportes',
        'fechaCreacion',
        'status'
    ];

    public function scopeTipo($query, $tipoReporte)
    {
        if ($tipoReporte) {
            $query->where('idlistaReportes', "=", "$tipoReporte");
        }
    }

    public function scopeEstatus($query, $status)
    {
        if ($status) {
            $query->where('status', "LIKE", "$status");
        }
    }
}
