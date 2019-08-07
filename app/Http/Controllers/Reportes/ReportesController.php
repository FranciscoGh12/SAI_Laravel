<?php

namespace SAI\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use SAI\Http\Controllers\Controller;
use DB;
use TCPDF;
use Illuminate\Support\Facades\Redirect;

class ReportesController extends Controller
{
    protected $infoReportes;

    public function index($idreportes)
    {
        $this->infoReportes = DB::table('reportes')->where('idreportes',$idreportes)->get();
        $this->downloadPDF($this->infoReportes);
        return view('verMasReportes')->with('infoReportes',$this->infoReportes);
    }

    public function guardaCambios(Request $request, $idreportes)
    {
        if (isset($_POST['cancelar'])) {
            return Redirect::to('/consultareporte');
        } else {
            $data=array();

            if (($request->nombre!=null)) {
                # code...
            }
        }

    }

    public function vistaPDF()
    {
        $url = $_SERVER['DOCUMENT_ROOT'].'/temp/verMasReportes.pdf';
        if (file_exists($url)) {
            return response()->file($url)->deleteFileAfterSend();
        } else{
            return Redirect::back()->with('message','Operation Successful !');
        }

    }

    public function downloadPDF($infoReportes)
    {
        $infoReportes_pdf = $infoReportes;
        $pdf = new MyPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('webmaster');
        $pdf->SetTitle('VerMasReportes');
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetFooterMargin(17); //36 20
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->addPage();
        $view = \view('PDF.pdf_vermas_reportes')
        ->with('infoReportes_pdf',$infoReportes_pdf);
        $html_content = $view->render();
        $pdf->writeHTML($html_content, true, false, true, false, '');
        $pdf->lastPage();

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/temp/verMasReportes.pdf', 'F');
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
