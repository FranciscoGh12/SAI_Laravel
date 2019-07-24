<?php

namespace SAI\Http\Controllers\ConsultadeReportes;

use Illuminate\Http\Request;
use SAI\Http\Controllers\Controller;
use DB;
use SAI\ConsultaTipoReportes;
use TCPDF;

class ConsultadeReportesController extends Controller
{
    public function index()
    {
        $listado_reportes = DB::table('tlv_1821_lr')->where('status', 'AC')->get();
        $all_listaReporte_info = DB::table('tlv_1821_lr')->get();
        $this->downloadPDF($all_listaReporte_info);
        return view('consultadeReportes')
            ->with('listado_reportes', $listado_reportes)
            ->with('all_listaReporte_info', $all_listaReporte_info);
    }

    public function filtrado_tipo_reporte(Request $request)
    {
        $all_listaReporte_info = DB::table('tlv_1821_lr')->get();
        $search_tipoReporte = $request->get('tipoReporte');
        $search_status = $request->get('estatus');

        $listado_reportes = ConsultaTipoReportes::orderBy('fechaCreacion', 'desc')
            ->tipo($search_tipoReporte)
            ->estatus($search_status)
            ->get();
        $this->downloadPDF($listado_reportes);
        return view('consultadeReportes')
        ->with('all_listaReporte_info', $all_listaReporte_info)
        ->with('listado_reportes',$listado_reportes);
    }
    public function vistaPDF()
    {
        $url = $_SERVER['DOCUMENT_ROOT'].'/temp/tipo_reporte.pdf';
        if (file_exists($url)) {
            return response()->file($url)->deleteFileAfterSend();
        } else{
            $this->index();
            return response()->file($url)->deleteFileAfterSend();
        }

    }

    public function downloadPDF($listado_reportes)
    {
        $all_listaReporte_info_pdf = DB::table('tlv_1821_lr')->get();
        $listado_reportes = DB::table('tlv_1821_lr')->get();

        $pdf = new MyPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('webmaster');
        $pdf->SetTitle('listadoReportes');
        $pdf->SetMargins(10, 40, 10);
        $pdf->SetFooterMargin(17); //36 20
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->addPage();
        $view = \view('PDF.pdf_consulta_tipo_reportes')
            ->with('all_listaReporte_info_pdf', $all_listaReporte_info_pdf);
        $html_content = $view->render();
        $pdf->writeHTML($html_content, true, false, true, false, '');
        $pdf->lastPage();

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/temp/tipo_reporte.pdf', 'F');
    }
}

class MyPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        $contenido = '<img src = "img/pdf_header.jpg" width = "1000" height= "130">';
        $this->writeHTML($contenido, true, false, true, false, '');
    }

    // Page footer

    public function Footer()
    {
        $contenido = '';
        $contenido = '<img src = "img/pdf_footer.jpg" width = "10000" height= "600">';
        $this->writeHTML($contenido, true, false, true, false, '');
    }
}
