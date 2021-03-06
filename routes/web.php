<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.loginSai');
});

Route::post('login','Auth\LoginController@login');
Route::get('index','Home\HomeController@index');
Route::get('altareporte','AltaReporte\AltaReporteController@index');
Route::get('altatramite','AltaTramite\AltaTramiteController@index');
Route::get('altausuario','AltaUsuario\AltaUsuarioController@index');
Route::get('consultaPersonal','ConsultaPersonal\ConsultaPersonalController@index');
Route::get('consultaTramite','ConsultaTramite\ConsultaTramiteController@index');
Route::get('consultareporte','ConsultaReporte\ConsultaReporteController@index');
Route::get('consultadeReportes','ConsultadeReportes\ConsultadeReportesController@index');
Route::post('consultaReporte/exportacion','ConsultaReporte\ConsultaReporteController@export');
Route::get('logout','Auth\LoginController@logout');
Route::get('editarListaReporte/{idlistaReporte}','ListaReporte\ListaReporteController@index');
Route::post('guardarEditadoListaReporte/{idlistaReporte}','ListaReporte\ListaReporteController@guardarCambios');
Route::get('verMasTramites/{idtramites}','Tramites\TramitesController@index');
Route::get('verMasReportes/{idreportes}','Reportes\ReportesController@index');
Route::get('actualizarPersonal/{correoInstitucional}','Personal\PersonalController@index');
Route::post('altausuario/registro','AltaUsuario\AltaUsuarioController@AltaUsuario');
Route::post('consultaTramite/busqueda', 'ConsultaTramite\ConsultaTramiteController@filtrado_tramites');
Route::post('consultaPersonal/busqueda', 'ConsultaPersonal\ConsultaPersonalController@filtrado_personal');
Route::post('consultaReporte/busqueda','ConsultaReporte\ConsultaReporteController@filtrado_reporte');
Route::post('consultadeReportes/busqueda','ConsultadeReportes\ConsultadeReportesController@filtrado_tipo_reporte');
Route::post('consultaReporte/fetch','ConsultaReporte\ConsultaReporteController@fetch');
Route::post('altareporte/registro','AltaReporte\AltaReporteController@AltaReporte');
Route::post('altatramite/registro','AltaTramite\AltaTramiteController@AltaTramite');
Route::post('consultaReporte/PdfTabla','ConsultaReporte\ConsultaReporteController@vistaPDF');
Route::post('consultadeReporte/PdfTabla','ConsultadeReportes\ConsultadeReportesController@vistaPDF');
Route::post('consultaPersonal/PdfTabla','ConsultaPersonal\ConsultaPersonalController@vistaPDF');
Route::post('consultaTramite/PdfTabla','ConsultaTramite\ConsultaTramiteController@vistaPDF');
Route::post('verMasReportes/PdfTabla','Reportes\ReportesController@vistaPDF');
Route::post('guardarEditadoTramite/{idtramites}','Tramites\TramitesController@guardarCambios');
Route::post('guardarEditadoPersonal/{correoInstitucional}','Personal\PersonalController@guardarCambios');
Route::post('guardarEditadoReporte/{idreportes}','Reportes\ReportesController@guardarCambios');
//Route::get('pdf_consulta_reportes','PDFController@index');



