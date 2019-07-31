<?php

namespace SAI\Http\Controllers\ConsultaTramite;

use Illuminate\Http\Request;
use SAI\Http\Controllers\Controller;
use DB;
use TCPDF;
use SAI\ConsultaTramites;

class ConsultaTramiteController extends Controller
{
    protected $tramites_info;


    public function index()
    {
        $this->tramites_info=DB::table('tlv_1821_tr')->where('status','AC')->get();
        $tipo_de_tramite_info=DB::table('tipotramite')->get();
        $all_area_info = DB::table('tlv_1821_ar')->get();

        $this->downloadPDF($this->tramites_info);
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

        if($search_area != "" || $search_tipoTramite != "" || $search_estatus != ""){
            if ($search_area!="") {
                $this->tramites_info = DB::select("SELECT * FROM tlv_1821_tr WHERE idarea= '$search_area' ");
                $this->downloadPDF($this->tramites_info);
            } else {
                $this->tramites_info= ConsultaTramites::orderBy('ultimaActualizacion', 'desc')
                ->tipo($search_tipoTramite)
                ->estatus($search_estatus)
                ->get();
                $this->downloadPDF($this->tramites_info);
            }
        }else{
            $this->index();
        }

        return view('consultaTramite')->with('tramites_info', $this->tramites_info)
        ->with('tipo_de_tramite_info', $tipo_de_tramite_info)
        ->with('all_area_info', $all_area_info);

    }

    public function vistaPDF()
    {
        $url = $_SERVER['DOCUMENT_ROOT'].'/temp/tramites.pdf';
        if (file_exists($url)) {
            return response()->file($url)->deleteFileAfterSend();
        } else{
            $this->index();
            return response()->file($url)->deleteFileAfterSend();
        }

    }

    public function downloadPDF($listado_tramites)
    {
        $tramites_info = $listado_tramites;

        $pdf = new MyPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('webmaster');
        $pdf->SetTitle('tramites');
        $pdf->SetMargins(10, 40, 10);
        $pdf->SetFooterMargin(17); //36 20
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->addPage();
        $view = \view('PDF.pdfConsultaTramites')
        ->with('tramites_info',$tramites_info);
        $html_content = $view->render();
        $pdf->writeHTML($html_content, true, false, true, false, '');
        $pdf->lastPage();

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/temp/tramites.pdf', 'F');
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
