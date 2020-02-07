<?php
namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use sis5cs\Persona;
use sis5cs\Profesion;
use sis5cs\TipoCredito;
use sis5cs\Requisitos;
use sis5cs\Credito;
use sis5cs\TipoMoneda;
use sis5cs\DestinoCredito;
use sis5cs\Direccion;
use sis5cs\TipoVivienda;
//use sis5cs\DatosActividadEconomica;
use sis5cs\ActividadEconomica;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use Fpdf;
use Auth;
use Alert;
use Carbon\Carbon;
class ReporteClienteController extends Controller
{
	public function solicitud()
     {   

         $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/plantillas/solicitud.docx'); 

//consulta usuario actual del sistema
     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
   //Datos Persona
     $persona=DB::table('persona')
     ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
     ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
     ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
     ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion','estado_civil.estado_civil')
     ->where('id_persona',$id_persona)
     ->get();   

     //TABLA CREDITO
     $credito=DB::table('credito')
     ->join('tipo_moneda', 'credito.id_tipo_moneda', '=', 'tipo_moneda.id_tipo_moneda')
     ->join('tipo_periodo_pago', 'credito.id_periodo_pago', '=', 'tipo_periodo_pago.id_periodo_pago')
     ->join('tipo_amortizacion', 'credito.id_tamortizacion', '=', 'tipo_amortizacion.id_tamortizacion')
     ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
     ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito')
     ->select('credito.*', 'tipo_moneda.tipo_moneda', 'tipo_periodo_pago.periodo_pago','tipo_amortizacion.amortizacion','tipo_credito.tipo_credito','destino_credito.destino_credito')
     ->where('id_persona',$id_persona)
     ->get();
     //TABLA DIRECCION
     $direccion=DB::table('direccion')
     ->join('tipo_vivienda', 'direccion.id_tipo_vivienda', '=', 'tipo_vivienda.id_tipo_vivienda')
     ->select('direccion.*', 'tipo_vivienda.tipo_vivienda')
     ->where('id_persona',$id_persona)
     ->get();
     //TABLA ACTIVIDAD ECONOMICA
     $actividad=ActividadEconomica::where('id_persona',$id_persona)->firstOrFail();

    // dd($direccion);  
     //llamada a procedimiento almacenado
     //$resultado=DB::select("select fn_sumar(6,2)");

     $templateWord->setValue('s_nombre',$persona[0]->nombre);
     $templateWord->setValue('s_ap_paterno',$persona[0]->ap_paterno);
     $templateWord->setValue('s_ap_materno',$persona[0]->ap_materno);
     $templateWord->setValue('s_ci',$persona[0]->ci);
     $templateWord->setValue('s_edad',Carbon::parse($persona[0]->fec_nac)->age);
     $templateWord->setValue('s_fec_nac',$persona[0]->fec_nac);
     $templateWord->setValue('s_lugar_nac',$persona[0]->lugar_nac);
     $templateWord->setValue('s_civil',$persona[0]->estado_civil);
     $templateWord->setValue('s_dependientes',$persona[0]->dependientes);
     $templateWord->setValue('s_profesion',$persona[0]->profesion);
     $templateWord->setValue('s_telefono',$persona[0]->celular);

     //tabla credito
     $templateWord->setValue('s_monto',$credito[0]->monto_solicitado);
     $templateWord->setValue('s_tipo_moneda',$credito[0]->tipo_moneda);
     $templateWord->setValue('s_plazo_meses',$credito[0]->plazo_meses);
     $templateWord->setValue('s_dia_pago',$credito[0]->dia_pago);
     $templateWord->setValue('s_destino',$credito[0]->destino_credito);
     //tabla direccion
     $templateWord->setValue('s_direccion',$direccion[0]->cll_principal);
     $templateWord->setValue('s_numero',$direccion[0]->direc_numero);
     $templateWord->setValue('s_c_referencia',$direccion[0]->cll_secundaria);
     $templateWord->setValue('s_zona',$direccion[0]->zona);
     $templateWord->setValue('s_vivienda',$direccion[0]->tipo_vivienda);
     //tabla actividad economica
     $templateWord->setValue('s_direccion_aeco',$actividad->direccion_ae);
     $templateWord->setValue('s_ingreso_promedio_aeco',$actividad->ingreso_promedio_ae);
     $templateWord->setValue('s_antiguedad_aeco',$actividad->antiguedad_trabajo_ae);
     $templateWord->setValue('s_telefono_aeco',$actividad->telefono_ae); 

//---Tabla 
// Asignamos valores a conyugue

// Asignamos valores a garante
// --- Guardamos el documento
     $templateWord->saveAs('Documento02.docx');
     header("Content-Disposition: attachment; filename=solicitud.docx; charset=iso-8859-1");
     echo file_get_contents('Documento02.docx');

}
}
