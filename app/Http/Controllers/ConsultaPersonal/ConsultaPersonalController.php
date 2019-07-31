<?php

namespace SAI\Http\Controllers\ConsultaPersonal;

use Illuminate\Http\Request;
use SAI\Http\Controllers\Controller;
use DB;
use TCPDF;
use SAI\ConsultaPersonal;

class ConsultaPersonalController extends Controller
{
    protected $all_personal_info;

    public function index()
    {
        $this->all_personal_info = DB::table('tlv_1821_u')->where('status', 'AC')->get();
        $all_area_info = DB::table('tlv_1821_ar')->get();
        $all_rol_info = DB::table('rol')->get();
        $this->downloadPDF($this->all_personal_info);

        return view('consultaPersonal')
        ->with('all_personal_info',$this->all_personal_info)
        ->with('all_area_info', $all_area_info)
        ->with('all_rol_info',$all_rol_info);
    }

    public function filtrado_personal(Request $request)
    {
        $all_area_info = DB::table('tlv_1821_ar')->get();
        $all_rol_info = DB::table('rol')->get();

        $search_status=$request->get('estatus');
        $search_area=$request->get('areas');
        $search_rol=$request->get('roles');
        $search_nombre=$request->get('search_nombre');

        if($search_status != "" || $search_area != "" || $search_rol != "" || $search_nombre != ""){
            if ($search_area!="") {
                $this->all_personal_info = DB::select("SELECT * FROM tlv_1821_u WHERE idarea= '$search_area' ");
                $this->downloadPDF($this->all_personal_info);
            } else {
                $this->all_personal_info = ConsultaPersonal::orderBy('nombre', 'asc')
                ->nombre($search_nombre)
                ->rol($search_rol)
                ->estatus($search_status)
                ->get();

                $this->downloadPDF($this->all_personal_info);
            }
        }else{
            $this->index();
        }

        return view('consultaPersonal')
        ->with('all_personal_info',$this->all_personal_info)
        ->with('all_area_info', $all_area_info)
        ->with('all_rol_info',$all_rol_info);

    }

    public function vistaPDF()
    {
        $url = $_SERVER['DOCUMENT_ROOT'].'/temp/personal.pdf';
        if (file_exists($url)) {
            return response()->file($url)->deleteFileAfterSend();
        } else{
            $this->index();
            return response()->file($url)->deleteFileAfterSend();
        }

    }

    public function downloadPDF($listado_personal)
    {
        $all_personal_info = $listado_personal;

        $pdf = new MyPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('webmaster');
        $pdf->SetTitle('personal');
        $pdf->SetMargins(10, 40, 10);
        $pdf->SetFooterMargin(17); //36 20
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->addPage();
        $view = \view('PDF.pdfConsultaPersonal')
        ->with('all_personal_info',$all_personal_info);
        $html_content = $view->render();
        $pdf->writeHTML($html_content, true, false, true, false, '');
        $pdf->lastPage();

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/temp/personal.pdf', 'F');
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
