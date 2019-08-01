<?php

namespace SAI\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use SAI\Http\Controllers\ConsultaReporte\ConsultaReporteController;

class ReportExport implements FromView
{
    protected $var;

    public function _construct($string)
    {
        $this->var = $string;
    }

    public function view(): View
    {
        $all_area_info = DB::table('tlv_1821_ar')->get();
        $all_colonia_info = DB::table('colonia')->get();
        $all_listaReporte_info = DB::table('tlv_1821_lr')->get();
        $all_consultaReporte_info_pdf = DB::select($this->var);
        return view('Excel.excel_consulta')
        ->with('all_consultaReporte_info_pdf', $all_consultaReporte_info_pdf)
        ->with('all_area_info', $all_area_info)
        ->with('all_listaReporte_info', $all_listaReporte_info)
        ->with('all_colonia_info', $all_colonia_info);
    }
}
