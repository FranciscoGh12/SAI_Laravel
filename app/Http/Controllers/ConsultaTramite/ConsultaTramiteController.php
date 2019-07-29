<?php

namespace SAI\Http\Controllers\ConsultaTramite;

use Illuminate\Http\Request;
use SAI\Http\Controllers\Controller;
use DB;
use SAI\ConsultaTramites;

class ConsultaTramiteController extends Controller
{
    protected $tramites_info;


    public function index()
    {
        $this->tramites_info=DB::table('tlv_1821_tr')->where('status','AC')->get();
        $tipo_de_tramite_info=DB::table('tipotramite')->get();
        $all_area_info = DB::table('tlv_1821_ar')->get();
        return view('consultaTramite')
        ->with('tramites_info',$this->tramites_info)
        ->with('tipo_de_tramite_info', $tipo_de_tramite_info)
        ->with('all_area_info', $all_area_info);
    }

    public function filtrado_tramites(Request $request)
    {
        $tipo_de_tramite_info=DB::table('tipotramite')->get();
        $all_area_info = DB::table('tlv_1821_ar')->get();
        $search_tipoTramite= $request->get('tipoTramite');
        $search_estatus= $request->get('estatus');
        $search_area= $request->get('area');

        if ($search_area!="") {
            $this->tramites_info = DB::select("SELECT * FROM tlv_1821_tr WHERE idarea= '$search_area' ");
        } else {
        $this->tramites_info= ConsultaTramites::orderBy('ultimaActualizacion', 'desc')
        ->tipo($search_tipoTramite)
        ->estatus($search_estatus)
        ->get();
        }

        return view('consultaTramite')->with('tramites_info', $this->tramites_info)
        ->with('tipo_de_tramite_info', $tipo_de_tramite_info)
        ->with('all_area_info', $all_area_info);

    }
}
