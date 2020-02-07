<?php

namespace sis5cs\Http\Controllers\JefeCredito;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;


class ReporteJefeCreditoController extends Controller
{
  public function cartera_masiva()
  {       
     $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/plantillas/jefecredito/cartera.docx'); 

     $now=Carbon::now()->format('l d, F Y');
     dd($now);
     $prueba='prueba';
     $templateWord->setValue('prueba',$prueba);

//---Tabla 
// Asignamos valores a conyugue

// Asignamos valores a garante

// --- Guardamos el documento
     $templateWord->saveAs('Documento02.docx');
     header("Content-Disposition: attachment; filename=cartera.docx; charset=iso-8859-1");
     echo file_get_contents('Documento02.docx');

}
}
