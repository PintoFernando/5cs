<?php

namespace sis5cs\Http\Controllers\Riesgos;

use Carbon\Carbon;
use Session;
use sis5cs\Conyugue;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Repositories\Riesgos\InformeRiesgosRepository;

class InformeController extends Controller
{
    protected $id_persona;
    protected $id_credito;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function garantes()
    {
        $this->iniciar();
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/riesgos/informe_garantes.docx');
        /*Tab necesarias
        CapacidadPago
         */
        if ($this->id_credito == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('riesgos/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $socio_nombre = InformeRiesgosRepository::persona($this->id_persona)->first()->nombre . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar(InformeRiesgosRepository::persona($this->id_persona)->first()->ci . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar(InformeRiesgosRepository::persona($this->id_persona)->first()->estado_civil));
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $id_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->first()->conyugue;
            $templateWord->setValue('socio_conyuge_nombre', $this->comprobar(InformeRiesgosRepository::persona($id_conyugue)->first()->nombre . ' ' . InformeRiesgosRepository::persona($id_conyugue)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($id_conyugue)->first()->ap_materno));
            $templateWord->setValue('socio_conyuge_ci', $this->comprobar(InformeRiesgosRepository::persona($id_conyugue)->first()->ci));
        } else {
            $templateWord->setValue('socio_conyuge_nombre', " ");
            $templateWord->setValue('socio_conyuge_ci', " ");
        }
        //-----------------------------------Socio Conyuge ends-------------------------------------------------

        /*------------------------------------Capacidad de pago-------------------------------------------------*/
        $capacidad = new InformeRiesgosRepository();
        $templateWord->setValue('porcentage_capacidad_pago', $this->comprobar($capacidad->capacidadPago($this->id_persona)));
        /*------------------------------------Capacidad de pago-------------------------------------------------*/

        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format(InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------

        /*----------------------------------Fecha inicio y fin-----------------------------------------------------*/
        $templateWord->setValue('fecha_inicio', $this->comprobar(Carbon::parse(InformeRiesgosRepository::credito($this->id_credito)->first()->created_at))->format('d-m-Y'));
        $templateWord->setValue('fecha_fin', $this->comprobar(InformeRiesgosRepository::seguimiento($this->id_credito)));
        /*----------------------------------Fecha inicio y fin-----------------------------------------------------*/
        /*----------------------------------Calculo Cuota/Ingreso Begin------------------------------------------------*/
        $ci = InformeRiesgosRepository::cuota_mensual($this->id_persona) / InformeRiesgosRepository::ingreso_total($this->id_persona);
        $templateWord->setValue('cuota_mensual', number_format(InformeRiesgosRepository::cuota_mensual($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('ingreso_total', number_format(InformeRiesgosRepository::ingreso_total($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('dat_rci', round($ci * 100, 2));
        $templateWord->setValue('patrimonio', number_format(InformeRiesgosRepository::patrimonio($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('monto', number_format(InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2, ',', '.'));
        $templateWord->setValue('patrimonio_monto', round(InformeRiesgosRepository::patrimonio($this->id_persona) / InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2));
        /*----------------------------------Calculo Cuota/Ingreso Ends-------------------------------------------------*/

        /*----------------------------------Save document Begin---------------------------------------------------------*/
        $file_name = 'Informe_de_credito_con_garantes ' . InformeRiesgosRepository::persona($this->id_persona)->first()->nombre . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_materno;
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
        /*-----------------------------------------------Save Document Ends----------------------------------------------------------*/

    }

    public function consumo_sola_firma()
    {
        $this->iniciar();
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/riesgos/informe_sola_firma.docx');
        /*Tab necesarias
        CapacidadPago
         */
        if ($this->id_credito == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('riesgos/dashboard/');
        }
        //-----------------------------------------------Datos Persona Socio----------------------------------------------
        $socio_nombre = InformeRiesgosRepository::persona($this->id_persona)->first()->nombre . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar(InformeRiesgosRepository::persona($this->id_persona)->first()->ci . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar(InformeRiesgosRepository::persona($this->id_persona)->first()->estado_civil));
        //------------------------------------------Persona Socio ends----------------------------------------------------
        //------------------------------------------Socio Counyugue Begin--------------------------------------------

        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $id_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->first()->conyugue;
            $templateWord->setValue('socio_conyuge_nombre', $this->comprobar(InformeRiesgosRepository::persona($id_conyugue)->first()->nombre . ' ' . InformeRiesgosRepository::persona($id_conyugue)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($id_conyugue)->first()->ap_materno));
            $templateWord->setValue('socio_conyuge_ci', $this->comprobar(InformeRiesgosRepository::persona($id_conyugue)->first()->ci));
        } else {
            $templateWord->setValue('socio_conyuge_nombre', " ");
            $templateWord->setValue('socio_conyuge_ci', " ");
        }
        //-----------------------------------Socio Conyuge ends-------------------------------------------------
        /*------------------------------------Capacidad de pago-------------------------------------------------*/
        $capacidad = new InformeRiesgosRepository();
        $templateWord->setValue('porcentage_capacidad_pago', $this->comprobar($capacidad->capacidadPago($this->id_persona)));
        /*------------------------------------Capacidad de pago-------------------------------------------------*/

        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format(InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------

        /*----------------------------------Fecha inicio y fin-----------------------------------------------------*/
        $templateWord->setValue('fecha_inicio', $this->comprobar(Carbon::parse(InformeRiesgosRepository::credito($this->id_credito)->first()->created_at))->format('d-m-Y'));
        $templateWord->setValue('fecha_fin', InformeRiesgosRepository::seguimiento($this->id_credito));
        /*----------------------------------Fecha inicio y fin-----------------------------------------------------*/
        /*----------------------------------Calculo Cuota/Ingreso Begin------------------------------------------------*/
        $ci = InformeRiesgosRepository::cuota_mensual($this->id_persona) / InformeRiesgosRepository::ingreso_total($this->id_persona);
        $templateWord->setValue('cuota_mensual', number_format(InformeRiesgosRepository::cuota_mensual($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('ingreso_total', number_format(InformeRiesgosRepository::ingreso_total($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('dat_rci', round($ci * 100, 2));
        $templateWord->setValue('patrimonio', number_format(InformeRiesgosRepository::patrimonio($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('monto', number_format(InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2, ',', '.'));
        $templateWord->setValue('patrimonio_monto', round(InformeRiesgosRepository::patrimonio($this->id_persona) / InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2));
        /*----------------------------------Calculo Cuota/Ingreso Ends-------------------------------------------------*/

        /*----------------------------------Save document Begin---------------------------------------------------------*/
        $file_name = 'Informe de credito ' . InformeRiesgosRepository::persona($this->id_persona)->first()->nombre . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_materno . ' ' . 'Informe_Prestamo_Sola_Firma';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
        /*-----------------------------------------------Save Document Ends----------------------------------------------------------*/
    }
    public function garantia_hipotecaria()
    {
        $this->iniciar();
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(public_path() . '/plantillas/riesgos/informe_hipotecaria_vivienda.docx');
        /*Tab necesarias
        CapacidadPago
         */

        if ($this->id_credito == null) {
            alert()->info('Info', 'Seleccione Socio - Crédito')->showConfirmButton();
            return redirect('riesgos/dashboard/');
        }
        //--------------------------------------Datos Persona Socio----------------------------------------------
        $socio_nombre = InformeRiesgosRepository::persona($this->id_persona)->first()->nombre . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_materno;
        $templateWord->setValue('socio_nombre', $this->comprobar($socio_nombre));
        $templateWord->setValue('socio_ci', $this->comprobar(InformeRiesgosRepository::persona($this->id_persona)->first()->ci . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->extension));
        $templateWord->setValue('socio_estado_civil', $this->comprobar(InformeRiesgosRepository::persona($this->id_persona)->first()->estado_civil));
        $templateWord->setValue('edad', $this->comprobar(Carbon::parse(InformeRiesgosRepository::persona($this->id_persona)->first()->fec_nac))->age);
        //-----------------------------------Persona Socio ends----------------------------------------------------
        //-----------------------------------Socio Counyugue Begin-------------------------------------------------
        $e_conyuge = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($e_conyuge > 0) {
            $id_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->first()->conyugue;
            $templateWord->setValue('socio_conyuge_nombre', $this->comprobar(InformeRiesgosRepository::persona($id_conyugue)->first()->nombre . ' ' . InformeRiesgosRepository::persona($id_conyugue)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($id_conyugue)->first()->ap_materno));
            $templateWord->setValue('socio_conyuge_ci', $this->comprobar(InformeRiesgosRepository::persona($id_conyugue)->first()->ci));
        }
        //-----------------------------------Socio Conyuge ends-------------------------------------------------
        /*------------------------------------Capacidad de pago-------------------------------------------------*/
        $capacidad = new InformeRiesgosRepository();
        $templateWord->setValue('porcentage_capacidad_pago', $this->comprobar($capacidad->capacidadPago($this->id_persona)));
        /*------------------------------------Capacidad de pago-------------------------------------------------*/

        //-----------------------------------Crédito Socio Begin--------------------------------------------------
        $templateWord->setValue('socio_monto_solicitado', $this->comprobar(number_format(InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2, ',', '.')));
        $templateWord->setValue('socio_destino_credito', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->destino_credito));
        $templateWord->setValue('credito_plazo', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->plazo_meses));
        $templateWord->setValue('credito_interes', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->interes_nominal * 100));
        $templateWord->setValue('tipo_moneda', $this->comprobar(InformeRiesgosRepository::credito($this->id_credito)->first()->tipo_moneda));
        //----------------------------------Crédito Socio Ends-----------------------------------------------------

        /*----------------------------------Fecha inicio y fin-----------------------------------------------------*/
        $templateWord->setValue('fecha_inicio', $this->comprobar(Carbon::parse(InformeRiesgosRepository::credito($this->id_credito)->first()->created_at))->format('d-m-Y'));
        $templateWord->setValue('fecha_fin', InformeRiesgosRepository::seguimiento($this->id_credito));
        /*----------------------------------Fecha inicio y fin-----------------------------------------------------*/

        /*----------------------------------Obligaciones ------------------------------------------------------------*/
        $obligacion = new InformeRiesgosRepository();
        $templateWord->setValue('obligaciones_mensuales', number_format($obligacion->obligaciones_mensuales($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('obligaciones_porcentaje', round(($obligacion->obligaciones_mensuales($this->id_persona) * 100 / $obligacion->ingreso_total($this->id_persona))), 2);
        /*---------------------------------------Obligaciones --------------------------------------------------------------*/
        /*---------------------------------------Calculo Cuota/Ingreso Begin------------------------------------------------*/
        $ci = InformeRiesgosRepository::cuota_mensual($this->id_persona) / InformeRiesgosRepository::ingreso_total($this->id_persona);
        $templateWord->setValue('cuota_mensual', number_format(InformeRiesgosRepository::cuota_mensual($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('ingreso_total', number_format(InformeRiesgosRepository::ingreso_total($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('dat_rci', round($ci * 100, 2));
        $templateWord->setValue('patrimonio', number_format(InformeRiesgosRepository::patrimonio($this->id_persona), 2, ',', '.'));
        $templateWord->setValue('monto', number_format(InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2, ',', '.'));
        $templateWord->setValue('patrimonio_monto', round(InformeRiesgosRepository::patrimonio($this->id_persona) / InformeRiesgosRepository::credito($this->id_credito)->first()->monto_solicitado, 2));
        /*----------------------------------Calculo Cuota/Ingreso Ends-------------------------------------------------*/

        /*----------------------------------Save document Begin---------------------------------------------------------*/
        $file_name = 'Informe de credito ' . InformeRiesgosRepository::persona($this->id_persona)->first()->nombre . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_paterno . ' ' . InformeRiesgosRepository::persona($this->id_persona)->first()->ap_materno . ' ' . 'Informe_Prestamo_Hipotecaria';
        $templateWord->saveAs('Documento02.docx');
        header("Content-Disposition: attachment; filename=$file_name.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');
        /*-----------------------------------------------Save Document Ends----------------------------------------------------------*/
    }

    //-----------------------------------------------FUNCIONES-------------------------------------------------
    protected function comprobar($dato)
    {
        if (isset($dato)) {
            return $dato;
        } else {
            return "....";
        }
    }

    //---------------------------------------------------------FUNCIONES DE BASE DE CONSULTA DE BASE DE DATOS--------------------------------------------------------------
    public function iniciar()
    {
        $this->id_persona = Session::get('id_persona');
        $this->id_credito = Session::get('id_credito');
    }
}
