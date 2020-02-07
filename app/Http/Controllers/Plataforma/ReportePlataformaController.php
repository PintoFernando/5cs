<?php

namespace sis5cs\Http\Controllers\Plataforma;

use Carbon\Carbon;
use DB;
use Session;
use sis5cs\Conyugue;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Persona;
use sis5cs\Direccion;

class ReportePlataformaController extends Controller
{
    public function solicitudOficial()
    {
        //Verificacion de  socio seleccionado
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('plataforma/dashboard/');
        }

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/oficial/solicitud.docx');
        //consulta usuario actual del sistema
        $id_persona = Session::get('id_persona'); //obtenemos el id del usuario actual del sistema
        $espacio=" ";
         //--------------------CONTROL DE TABLAS BEGIN-----------------------     
        $c_direccion = Direccion::where('id_persona', $id_persona)->get()->isEmpty();
        $c_conyugue = Conyugue::where('id_persona', $id_persona)->get()->isEmpty();
        if ($c_direccion) {
            alert()->info('Info', 'Llene los datos de dirección')->showConfirmButton();
            return redirect('plataforma/dashboard/');
        }
        
        //------------------------CONTROL DE TABLAS END----------------------

        //Datos Persona
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona','left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil','actividad_economica.*')
            ->where('persona.id_persona', $id_persona)
            ->get();

        $templateWord->setValue('nombre', $this->comprobar($persona->first()->nombre));
        $templateWord->setValue('s_ap_paterno', $this->comprobar($persona->first()->ap_paterno));
        $templateWord->setValue('s_ap_materno', $this->comprobar($persona->first()->ap_materno));
        $templateWord->setValue('s_ci', $this->comprobar($persona->first()->ci));
        $templateWord->setValue('s_edad', Carbon::parse($persona->first()->fec_nac)->age);
        $templateWord->setValue('s_fec_nac', $this->comprobar($persona->first()->fec_nac));
        $templateWord->setValue('s_lugar_nac', $this->comprobar($persona->first()->lugar_nac));
        $templateWord->setValue('s_civil', $this->comprobar($persona->first()->estado_civil));
        $templateWord->setValue('s_dependientes', $this->comprobar($persona->first()->dependientes));
        $templateWord->setValue('s_profesion', $this->comprobar($persona->first()->profesion));
        $templateWord->setValue('s_telefono', $this->comprobar($persona->first()->celular));
        //TABLA CREDITO
        $credito = DB::table('credito')
            ->join('tipo_moneda', 'credito.id_tipo_moneda', '=', 'tipo_moneda.id_tipo_moneda')
            ->join('tipo_periodo_pago', 'credito.id_periodo_pago', '=', 'tipo_periodo_pago.id_periodo_pago')
            ->join('tipo_amortizacion', 'credito.id_tamortizacion', '=', 'tipo_amortizacion.id_tamortizacion')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito')
            ->select('credito.*', 'tipo_moneda.tipo_moneda', 'tipo_periodo_pago.periodo_pago', 'tipo_amortizacion.amortizacion', 'tipo_credito.tipo_credito', 'destino_credito.destino_credito')
            ->where('id_persona', $id_persona)
            ->get();
        $templateWord->setValue('s_monto', $this->comprobar($credito->first()->monto_solicitado));
        $templateWord->setValue('s_tipo_moneda', $this->comprobar($credito->first()->tipo_moneda));
        $templateWord->setValue('s_plazo_meses', $this->comprobar($credito->first()->plazo_meses));
        $templateWord->setValue('s_dia_pago', $this->comprobar($credito->first()->dia_pago));
        $templateWord->setValue('s_destino', $this->comprobar($credito->first()->destino_credito));
        //TABLA DIRECCION
        $direccion = DB::table('direccion')
            ->join('tipo_vivienda', 'direccion.id_tipo_vivienda', '=', 'tipo_vivienda.id_tipo_vivienda', 'left outer')
            ->select('direccion.*', 'tipo_vivienda.tipo_vivienda')
            ->where('id_persona', $id_persona)
            ->get();
        $templateWord->setValue('s_direccion', $this->comprobar($direccion->first()->cll_principal));
        $templateWord->setValue('s_numero', $this->comprobar($direccion->first()->direc_numero));
        $templateWord->setValue('s_c_referencia', $this->comprobar($direccion->first()->cll_secundaria));
        $templateWord->setValue('s_zona', $this->comprobar($direccion->first()->zona));
        $templateWord->setValue('s_vivienda', $this->comprobar($direccion->first()->tipo_vivienda));       
        // $actividad = ActividadEconomica::where('id_persona', $id_persona)->firstOrFail();
        //llamada a procedimiento almacenado
        //$resultado=DB::select("select fn_sumar(6,2)");
        $templateWord->setValue('s_direccion_aeco', $this->comprobar($persona->first()->direccion_ae));
        $templateWord->setValue('s_antiguedad_aeco', $this->comprobar($persona->first()->antiguedad_trabajo_ae));
        $templateWord->setValue('s_telefono_aeco', $this->comprobar($persona->first()->telefono_ae));

        //--------------------------DATOS DE CONYUGUE--------------------------------
        if ($c_conyugue) {
            $templateWord->setValue('s_conyugue_ap_paterno', $espacio);
            $templateWord->setValue('s_conyugue_ap_materno', $espacio);
            $templateWord->setValue('s_conyugue_nombre', $espacio);
            $templateWord->setValue('s_conyugue_ci', $espacio);
            $templateWord->setValue('s_conyugue_edad', $espacio);
            $templateWord->setValue('s_conyugue_fec_nac', $espacio);
            $templateWord->setValue('s_conyugue_lugar_nac', $espacio);
            $templateWord->setValue('s_conyugue_estado_civil', $espacio);
            $templateWord->setValue('s_conyugue_dependientes', $espacio);
            $templateWord->setValue('s_conyugue_celular', $espacio);
            $templateWord->setValue('s_conyugue_direccion', $espacio);
            $templateWord->setValue('s_c_dn', $espacio);
            $templateWord->setValue('s_c_zona', $espacio);
            $templateWord->setValue('s_c_profesion', $espacio);
        }
        else
        {
            $conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
            $persona_conyugue = DB::table('persona')
                ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
                ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
                ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
                ->join('direccion', 'persona.id_persona', '=', 'direccion.id_persona','left outer')
                ->select('persona.*', 'profesion.profesion', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil','direccion.*')
                ->where('persona.id_persona', $conyugue)
                ->get();                
            $templateWord->setValue('s_conyugue_ap_paterno', $this->comprobar($persona_conyugue->first()->ap_paterno));
            $templateWord->setValue('s_conyugue_ap_materno', $this->comprobar($persona_conyugue->first()->ap_materno));
            $templateWord->setValue('s_conyugue_nombre', $this->comprobar($persona_conyugue->first()->nombre));
            $templateWord->setValue('s_conyugue_ci', $this->comprobar($persona_conyugue->first()->ci));
            $templateWord->setValue('s_conyugue_edad', Carbon::parse($persona_conyugue->first()->fec_nac)->age);
            $templateWord->setValue('s_conyugue_fec_nac', $this->comprobar($persona_conyugue->first()->fec_nac));
            $templateWord->setValue('s_conyugue_lugar_nac', $this->comprobar($persona_conyugue->first()->lugar_nac));
            $templateWord->setValue('s_conyugue_estado_civil', $this->comprobar($persona_conyugue->first()->estado_civil));
            $templateWord->setValue('s_conyugue_dependientes', $this->comprobar($persona_conyugue->first()->dependientes));
            $templateWord->setValue('s_conyugue_celular', $this->comprobar($persona_conyugue->first()->celular));
            $templateWord->setValue('s_conyugue_direccion', $this->comprobar($persona_conyugue->first()->cll_principal));
            $templateWord->setValue('s_c_dn', $this->comprobar($persona_conyugue->first()->direc_numero));
            $templateWord->setValue('s_c_zona', $this->comprobar($persona_conyugue->first()->zona));
            $templateWord->setValue('s_c_profesion', $this->comprobar($persona_conyugue->first()->profesion));
        }
       
        
        //--------------------------------Datos conyugue fin--------------------------------------------------------

        //--------------------------DATOS GARANTE------------------------------------
        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'Solicitud';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function caratulasOficial()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('plataforma/dashboard/');
        }

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/oficial/caratulas.docx');
        //consulta usuario actual del sistema
        $id_persona = Session::get('id_persona'); //obtenemos el id del usuario actual del sistema
        //Datos Persona
        $persona = Persona::where('id_persona', Session::get('id_persona'))->firstOrFail();
        $espacio = " ";
        //----------------------Tabla direccion- Begin-----------------------
        if ($persona->exists()) {
            $templateWord->setValue('numero_socio', $persona->num_socio);
            $templateWord->setValue('nombre', $persona->nombre);
            $templateWord->setValue('ap_paterno', $persona->ap_paterno);
            $templateWord->setValue('ap_materno', $persona->ap_materno);
        } else {
            $templateWord->setValue('numero_socio', $espacio);
            $templateWord->setValue('nombre', $espacio);
            $templateWord->setValue('ap_paterno', $espacio);
            $templateWord->setValue('ap_materno', $espacio);
        }
        //----------------------Tabla direccion- End-----------------------
        $file_name = "$persona->nombre $persona->ap_paterno $persona->ap_materno Caratulas";

        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function controlDocumentos()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('plataforma/dashboard/');
        }

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/oficial/controlDocumentos.docx');
        //consulta usuario actual del sistema
        $id_persona = Session::get('id_persona'); //obtenemos el id del usuario actual del sistema
        //Datos Persona
        $persona = Persona::where('id_persona', Session::get('id_persona'))->firstOrFail();
        $espacio = " ";
        $fecha = Carbon::now(); // 1990-10-25

        //----------------------Tabla direccion- Begin-----------------------
        if ($persona->exists()) {
            $templateWord->setValue('numero_socio', $persona->num_socio);
            $templateWord->setValue('nombre', $persona->nombre);
            $templateWord->setValue('ap_paterno', $persona->ap_paterno);
            $templateWord->setValue('ap_materno', $persona->ap_materno);
            $templateWord->setValue('fecha', $fecha);
        } else {
            $templateWord->setValue('numero_socio', $espacio);
            $templateWord->setValue('nombre', $espacio);
            $templateWord->setValue('ap_paterno', $espacio);
            $templateWord->setValue('ap_materno', $espacio);
        }
        //----------------------Tabla direccion- End-----------------------
        $file_name = "$persona->nombre $persona->ap_paterno $persona->ap_materno Control de documentos";

        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }
    public function informeCredito()
    {

        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione un crédito')->showConfirmButton();
            return redirect('plataforma/dashboard/');
        }

        //--------------------CONTROL DE TABLAS BEGIN-----------------------
        /*$c_persona = Persona::where('id_persona', Session::get('id_persona'))->firstOrFail()->get()->isEmpty();
        $c_credito = Credito::where('id_credito', Session::get('id_credito'))->firstOrFail()->get()->isEmpty();
        $c_actividad = ActividadEconomica::where('id_persona', Session::get('id_persona'))->get()->isEmpty();*/
        //------------------------CONTROL DE TABLAS END----------------------

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/oficial/informeCredito.docx');
        $fecha = Carbon::now(); // 1990-10-25

        //----------------------Tabla persona union- Begin-----------------------
        $persona_union = DB::table('persona')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->select('actividad_economica.*', 'persona.*')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();

        $templateWord->setValue('numero_socio', $this->comprobar($persona_union->first()->num_socio));
        $templateWord->setValue('nombre', $this->comprobar($persona_union->first()->nombre));
        $templateWord->setValue('ap_paterno', $this->comprobar($persona_union->first()->ap_paterno));
        $templateWord->setValue('ap_materno', $this->comprobar($persona_union->first()->ap_materno));
        $templateWord->setValue('actividad', $this->comprobar($persona_union->first()->actividad_qrealiza));
        //----------------------Tabla persona- End-------------------------
        //----------------------Tabla credito- Begin-----------------------
        $credito = DB::table('credito')
            ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito', 'left outer')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito', 'left outer')
            ->select('destino_credito.*', 'credito.*', 'tipo_credito.*')
            ->where('credito.id_persona', Session::get('id_persona'))
            ->get();
        //----------------------------Garantias-------------------
        $garantias = DB::table('garantia')
            ->join('tipo_garantia', 'garantia.id_tipo_garantia', '=', 'tipo_garantia.id_tipo_garantia')
            ->select('tipo_garantia.tipo_garantia')
            ->where('garantia.id_credito', Session::get('id_credito'))
            ->get();
        $todas_garantias = "";
        foreach ($garantias as $ga) {
            $todas_garantias = $todas_garantias . ' ' . $ga->tipo_garantia;
        }
        //-------------------------------Garantias end------------------

        $templateWord->setValue('monto', $this->comprobar($credito->first()->monto_solicitado));
        $templateWord->setValue('plazo', $this->comprobar($credito->first()->plazo_meses));
        $templateWord->setValue('destino', $this->comprobar($credito->first()->destino_credito));
        $templateWord->setValue('tasa', $this->comprobar($credito->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_credito', $this->comprobar($credito->first()->tipo_credito));
        $templateWord->setValue('fecha_solicitud', $this->comprobar($credito->first()->fecha_solicitud));
        $templateWord->setValue('garantias', $todas_garantias);

        //----------------------Tabla credito- End-----------------------
        $file_name = $persona_union->first()->nombre . ' ' . $persona_union->first()->ap_paterno . ' ' . $persona_union->first()->ap_materno . ' ' . 'Control de documentos';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }
    public function comprobar($dato)
    {
        if (isset($dato)) {
            return $dato;
        } else {
            return " ";
        }
    }
}
