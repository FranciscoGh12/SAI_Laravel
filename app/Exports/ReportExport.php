<?php

namespace SAI\Exports;

use App\User;
use DB;
use SAI\Http\Controllers\ConsultaReporte\ConsultaReporteController;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use SAI\ConsultaReportes;
use Illuminate\Contracts\View\View;

class ReportExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('Excel.excel_consulta',[
            'all_consultaReporte_info_pdf'=>ConsultaReportes::all()->where('status', 'EP')]);

    }

}
