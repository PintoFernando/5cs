<?php

namespace sis5cs\Http\Controllers\Asesoria;

use Carbon\Carbon;
use DB;
use Session;
use sis5cs\Conyugue;
use sis5cs\Credito;
use sis5cs\Direccion;
use sis5cs\Garante;
use sis5cs\GarantiaHipotecaria;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Persona;

class ContratosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function consumo_sola_firma()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/consumoAsolaFirma.docx');
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {            
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = "....";
            $socio_conyuge_ci = "....";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function consumo()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/consumo.docx');
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function consumo_garantia_hipotecaria()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/creditoConsumoGarantiaHipotecaria.docx');
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function credito_vivienda()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/creditoVivienda.docx');
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------
  
        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------

            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function hipotecario_vivienda()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/hipotecarioVivienda.docx');

        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function microcredito()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/microcredito.docx');
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function microcreditoAsolaFirma()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/microcreditoAsolaFirma.docx');

        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }

    public function microcreditoGarantiaHipotecaria()
    {
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/asesoria/contratos/microcreditoGarantiaHipotecaria.docx');
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('asesoria/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona'))
            ->get();
        $socio_nombre = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar($persona->first()->ci . ' ' . $persona->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar($persona->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $socio_conyuge_nombre = $this->socio_conyugue()->first()->nombre . ' ' . $this->socio_conyugue()->first()->ap_paterno . ' ' . $this->socio_conyugue()->first()->ap_materno;
            $socio_conyuge_ci = $this->socio_conyugue()->first()->ci . ' ' . $this->socio_conyugue()->first()->extension;
        } else {
            $socio_conyuge_nombre = " ";
            $socio_conyuge_ci = " ";
        }
        $templateWord->setValue('socio_conyuge_nombre', $socio_conyuge_nombre);
        $templateWord->setValue('socio_conyuge_ci', $socio_conyuge_ci);

        //-----------------------------------Socio Conyuge ends---------------------------------------------

        //-----------------------------------Direccion Begin----------------------------------------------------
        $templateWord->setValue('direccion_socio_calle_principal', $this->comprobar($this->direccion_socio()->first()->cll_principal));
        $templateWord->setValue('direccion_socio_numero', $this->comprobar($this->direccion_socio()->first()->direc_numero));
        $templateWord->setValue('direccion_socio_calle_sec', $this->comprobar($this->direccion_socio()->first()->cll_secundaria));
        $templateWord->setValue('direccion_socio_zona', $this->comprobar($this->direccion_socio()->first()->zona));
        //-----------------------------------Direccion Ends-------------------------------------------------
        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format($this->credito()->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar($this->credito()->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar($this->credito()->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar($this->credito()->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar($this->credito()->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------
        //-----------------------------------Fecha de documento----------------------------------------------------
        Carbon::setLocale('es');
        $fecha = Carbon::now();
        $templateWord->setValue('dia', $fecha->day);
        $templateWord->setValue('mes', $this->mes($fecha->month));
        $templateWord->setValue('anio', $fecha->year);
        //----------------------------------Fecha Calculo End -----------------------------------------------------
        //----------------------------------Begin Direccion Garante -----------------------------------------------

        if ($this->direccion_garante() === -1) {
            $templateWord->setValue('direccion_garante_calle_principal', ".... ");
            $templateWord->setValue('direccion_garante_calle_secundaria', ".... ");
            $templateWord->setValue('direccion_garante_zona', ".... ");
        } else {
            $templateWord->setValue('direccion_garante_calle_principal', $this->comprobar($this->direccion_garante()->first()->cll_principal));
            $templateWord->setValue('direccion_garante_calle_secundaria', $this->comprobar($this->direccion_garante()->first()->cll_secundaria));
            $templateWord->setValue('direccion_garante_zona', $this->comprobar($this->direccion_garante()->first()->zona));
        }
        //----------------------------------Ends Direccion Garante-------------------------------------------------
        //----------------------------------Begin Garante datos----------------------------------------------------

        if ($this->datos_garante() === -1) {
            $templateWord->setValue('garante_nombre', "....");
            $templateWord->setValue('garante_ci', "....");
            $templateWord->setValue('garante_estado_civil', "....");
        } else {
            $templateWord->setValue('garante_nombre', $this->comprobar($this->datos_garante()->first()->nombre . ' ' . $this->datos_garante()->first()->ap_paterno . ' ' . $this->datos_garante()->first()->ap_materno));
            $templateWord->setValue('garante_ci', $this->comprobar($this->datos_garante()->first()->ci));
            $templateWord->setValue('garante_estado_civil', $this->comprobar($this->datos_garante()->first()->estado_civil));
        }
        //----------------------------------Ends garante datos-----------------------------------------------------

        //----------------------------------Begin garantia hipotecaria--------------------------------------------

        if ($this->garantia_hipotecaria() === -1) {
            //--------------------------Vivienda-----------------------
            $templateWord->setValue('vivi_ubicacion_bien', "....");
            $templateWord->setValue('vivi_designacion', "....");
            $templateWord->setValue('vivi_superficie', "....");
            $templateWord->setValue('vivi_linderos', "....");
            $templateWord->setValue('vivi_libro_ddrr', "....");
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', "....");
            $templateWord->setValue('vehi_clase', "....");
            $templateWord->setValue('vehi_marca', "....");
            $templateWord->setValue('vehi_tipo', "....");
            $templateWord->setValue('vehi_subtipo', "....");
            $templateWord->setValue('vehi_modelo', "....");
            $templateWord->setValue('vehi_num_motor', "....");
            $templateWord->setValue('vehi_num_poliza', "....");
            $templateWord->setValue('vehi_chasis', "....");
            $templateWord->setValue('vehi_procedencia', "....");
            $templateWord->setValue('vehi_cilindrada', "....");
            $templateWord->setValue('vehi_color', "....");
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', "....");
            $templateWord->setValue('depo_num_dpf', "....");
            $templateWord->setValue('depo_monto', "....");
            $templateWord->setValue('depo_fecha_apertura', "....");
            $templateWord->setValue('depo_fecha_vencimiento', "....");
        } else {
            //--------------------------------Vivienda-----------------
            $templateWord->setValue('vivi_ubicacion_bien', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_ubicacion_bien));
            $templateWord->setValue('vivi_designacion', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_designacion));
            $templateWord->setValue('vivi_superficie', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_superficie));
            $templateWord->setValue('vivi_linderos', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_linderos));
            $templateWord->setValue('vivi_libro_ddrr', $this->comprobar($this->garantia_hipotecaria()->first()->vivi_libro_ddrr));
            //------------------------Movilidad-------------------------
            $templateWord->setValue('vehi_placa', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_placa));
            $templateWord->setValue('vehi_clase', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_clase));
            $templateWord->setValue('vehi_marca', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_marca));
            $templateWord->setValue('vehi_tipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_tipo));
            $templateWord->setValue('vehi_subtipo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_subtipo));
            $templateWord->setValue('vehi_modelo', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_modelo));
            $templateWord->setValue('vehi_num_motor', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_motor));
            $templateWord->setValue('vehi_num_poliza', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_num_poliza));
            $templateWord->setValue('vehi_chasis', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_chasis));
            $templateWord->setValue('vehi_procedencia', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_procedencia));
            $templateWord->setValue('vehi_cilindrada', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_cilindrada));
            $templateWord->setValue('vehi_color', $this->comprobar($this->garantia_hipotecaria()->first()->vehi_color));
            //------------------------DPF-------------------------------
            $templateWord->setValue('depo_entidad_emisora', $this->comprobar($this->garantia_hipotecaria()->first()->depo_entidad_emisora));
            $templateWord->setValue('depo_num_dpf', $this->comprobar($this->garantia_hipotecaria()->first()->depo_num_dpf));
            $templateWord->setValue('depo_monto', $this->comprobar(number_format($this->garantia_hipotecaria()->first()->depo_monto, 2, ',', '.')));
            $templateWord->setValue('depo_fecha_apertura', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));
            $templateWord->setValue('depo_fecha_vencimiento', $this->comprobar($this->garantia_hipotecaria()->first()->depo_fecha_apertura));

        }
        //----------------------------------Ends garantia hipotecaria---------------------------------------------

        $file_name = $persona->first()->nombre . ' ' . $persona->first()->ap_paterno . ' ' . $persona->first()->ap_materno . ' ' . 'contratoAsolaFirma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
    }
    //--------------------------------------------------------Funciones-----------------------------------------------------------------
    protected function comprobar($dato)
    {
        if (isset($dato)) {
            return $dato;
        } else {
            return "....";
        }
    }
    protected function mes($dato)
    {
        switch ($dato) {
            case 1:return 'Enero';
                break;
            case 2:return 'Febrero';
                break;
            case 3:return 'Marzo';
                break;
            case 4:return 'Abril';
                break;
            case 5:return 'Mayo';
                break;
            case 6:return 'Junio';
                break;
            case 7:return 'Julio';
                break;
            case 8:return 'Agosto';
                break;
            case 9:return 'Septiembre';
                break;
            case 10:return 'Octubre';
                break;
            case 11:return 'Noviembre';
                break;
            case 12:return 'Diciembre';
                break;
        }
    }

    //---------------------------------------------------------Funciones de consulta a bd--------------------------------------------------------------
    protected function credito()
    {
        $credito = DB::table('credito')
            ->join('tipo_moneda', 'credito.id_tipo_moneda', '=', 'tipo_moneda.id_tipo_moneda')
            ->join('forma_pago', 'credito.id_forma_pago', '=', 'forma_pago.id_forma_pago')
            ->join('tipo_periodo_pago', 'credito.id_periodo_pago', '=', 'tipo_periodo_pago.id_periodo_pago')
            ->join('tipo_amortizacion', 'credito.id_tamortizacion', '=', 'tipo_amortizacion.id_tamortizacion')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito')
            ->select('credito.*', 'tipo_moneda.tipo_moneda', 'forma_pago.forma_pago', 'tipo_periodo_pago.periodo_pago', 'tipo_amortizacion.amortizacion', 'tipo_credito.tipo_credito', 'destino_credito.destino_credito')
            ->where('credito.id_credito', Session::get('id_credito'))
            ->get();
        return $credito;
    }
    public function garante()
    {
        $garante = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', Session::get('id_persona_garante'))
            ->get();
        return $garante;
    }

    public function socio_conyugue()
    {
        $e_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyugue > 0) {
            $id_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
            $conyugue = DB::table('persona')
                ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
                ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
                ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
                ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
                ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
                ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
                ->where('persona.id_persona', $id_conyugue)
                ->get();
            return $conyugue;
        } else {
            return false;
        }
    }

    public function direccion_socio()
    {
        $direccion = DB::table('direccion')
            ->where('direccion.id_persona', Session::get('id_persona'))
            ->get();
        return $direccion;
    }

    public function garantia_hipotecaria()
    {
        $e_credito = Credito::where('id_persona', Session::get('id_persona'))->count();
        if ($e_credito > 0) {
            $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
            $e_garantia = GarantiaHipotecaria::where('id_credito', $id_credito)->count();
            if ($e_garantia > 0) {
                $garantia = GarantiaHipotecaria::where('id_credito', $id_credito)->get();
                return $garantia;
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }

    public function direccion_garante()
    {
        $e_garante = Garante::where('id_persona', Session::get('id_persona'))->count();
        if ($e_garante > 0) {
            $id_garante = Garante::where('id_persona', Session::get('id_persona'))->firstOrFail()->garante;
            $e_direccion = Direccion::where('id_persona', $id_garante)->count();
            if ($e_direccion > 0) {
                $direccion = Direccion::where('id_persona', $id_garante)->get();
                return $direccion;
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }

    public function datos_garante()
    {
        $e_garante = Garante::where('id_persona', Session::get('id_persona'))->count();
        if ($e_garante > 0) {
            $id_garante = Garante::where('id_persona', Session::get('id_persona'))->firstOrFail()->garante;
            $e_persona = Persona::where('id_persona', $id_garante)->count();
            if ($e_persona > 0) {

                $persona = DB::table('persona')
                    ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
                    ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
                    ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
                    ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
                    ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
                    ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
                    ->where('persona.id_persona', $id_garante)
                    ->get();
                return $persona;
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }
}
