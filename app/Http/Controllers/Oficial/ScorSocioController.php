<?php

namespace sis5cs\Http\Controllers\Oficial;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\ActividadEconomica;
use sis5cs\BienesHogar;
use sis5cs\CapacidadPago;
use sis5cs\Credito;
use sis5cs\CuentasDocumentosCobrar;
use sis5cs\CuentasPorPagar;
use sis5cs\DatosEmpresa;
use sis5cs\DepositoBancario;
use sis5cs\Direccion;
use sis5cs\EfectivoCaja;
use sis5cs\Garantia;
use sis5cs\GastosFamiliares;
use sis5cs\GastosOperativosComercializacion;
use sis5cs\Http\Controllers\Controller;
use sis5cs\IngresoMensual;
use sis5cs\Inmueble;
use sis5cs\InventarioMercaderia;
//c3
use sis5cs\InversionesFinancieras;
use sis5cs\MaquinariaEquipo;
use sis5cs\OtroActivo;
use sis5cs\Persona;
use sis5cs\PrestamoBancario;
use sis5cs\ReporteBuro;
use sis5cs\Repositories\ContadorC1Repository;
use sis5cs\Repositories\ContadorC2Repository;
//c5
use sis5cs\Repositories\ContadorC3Repository;
use sis5cs\Repositories\ContadorC4Repository;
use sis5cs\Repositories\ContadorC5Repository;
use sis5cs\Repositories\PuntajeRepository;
//repositories
use sis5cs\TipoCambio;
use sis5cs\TipoCredito;
use sis5cs\TipoGarantia;
use sis5cs\TipoVivienda;
use sis5cs\Vehiculo;
use sis5cs\VentaComercializacionProducto;

class ScorSocioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $personas = Persona::All();
        return view('oficial.scor.index')->with(compact('personas'));
    }

    public function scor()
    {
        //definir variable id
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione un Crédito')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $id = Session::get('id_persona');
        //tablas requeridas en el scoring
        $exi_credito = Credito::where('id_persona', $id)->get()->isEmpty();
        if ($exi_credito) {
            alert()->info('Info', 'Llene datos de credito')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $credito_id = Credito::where('id_persona', $id)->firstOrFail();
        $exi_direccion = Direccion::where('id_persona', $id)->get()->isEmpty();

        $exi_garantia = Garantia::where('id_credito', $credito_id->id_credito)->get()->isEmpty();
        $exi_reporte = ReporteBuro::where('id_persona', $id)->get()->isEmpty();
        $exi_efectivo = EfectivoCaja::where('id_persona', $id)->get()->isEmpty();
        $exi_capacidad = CapacidadPago::where('id_persona', $id)->get()->isEmpty();
        if ($exi_direccion) {
            alert()->info('Info', 'Llene datos de Dirección')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        if ($exi_garantia) {
            alert()->info('Info', 'Llene datos de garantia')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        if ($exi_reporte) {
            alert()->info('Info', 'Llene datos de Reporte Buro')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }

        if ($exi_capacidad) {
            alert()->info('Info', 'Llene datos de Amortizacion Coop San Martin')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }

        $persona = Persona::find($id);
        //tabla credito
        $credito = Credito::where('id_credito', Session::get('id_credito'))->firstOrFail();
        $capacidad_pago12 = CapacidadPago::where('id_persona', $id)->firstOrFail();
        $tipo_credito = TipoCredito::where('id_tcredito', $credito->id_tcredito)->firstOrFail()->tipo_credito;
        $edad = Carbon::parse($persona->fec_nac)->age; //1990-10-25
        //Tabla direccion
        $direccion = Direccion::where('id_persona', $id)->firstOrFail();
        $tipo_vivienda = TipoVivienda::where('id_tipo_vivienda', $direccion->id_tipo_vivienda)->firstOrFail()->tipo_vivienda;

        //creación de
        $now = Carbon::now();
        $tiempo_residencia = Carbon::parse($direccion->tiempo_residencia)->diffInMonths($now);
        //cálculo de puntaje
        $ptipo_residencia = PuntajeRepository::tipo_residencia($direccion->id_tipo_vivienda);
        //sol temporal puntaje cuando es propia
        if ($ptipo_residencia == 10) {
            $ptiempo_residencia = 10;
        } else {
            $ptiempo_residencia = PuntajeRepository::tiempo_residencia($tiempo_residencia);
        }
        $total_residencia = $ptipo_residencia + $ptiempo_residencia;
        //datos economicos Depenciente

        //datos de actividad economica (independiente)

        //calculo total de tiempo de negocio dependiente independiente
        $total_tiempo_negocio = PuntajeRepository::tiempoNegocio($this->tiempoTrabajoEmpresa($id)) + PuntajeRepository::tiempoNegocio($this->tiempoTrabajoActividad($id));
        //experiencia crediticia

        //calculo experiencia crediticia
        $total_experiencia_crediticia = PuntajeRepository::experiencia_cre_ultimo($this->experienciaCrediticia($id)) + PuntajeRepository::experiencia_cre_ultimo($this->penultima_experienciaCrediticia($id));
        //calculo total de c1
        $total_c1 = $total_residencia + $total_tiempo_negocio + $total_experiencia_crediticia;
        //porcentaje de c1

        // $tiempo_residencia,$this->tiempoTrabajoActividad($id),$this->tiempoTrabajoEmpresa($id),$this->experienciaCrediticia($id),$this->penultima_experienciaCrediticia($id)));

        $contador_c1 = ContadorC1Repository::contador_c1($direccion->id_tipo_vivienda, $tiempo_residencia, $this->tiempoTrabajoActividad($id), $this->tiempoTrabajoEmpresa($id), $this->experienciaCrediticia($id), $this->penultima_experienciaCrediticia($id));
        if ($contador_c1 == 0) {
            $porcentaje_c1 = 0;
        } else {
            $porcentaje_c1 = ($total_c1 * 25) / $contador_c1;
        }

        //CÁLCULO DE C2
        //Calculo de endeudamiento actual
        $gg_tipo_moneda = Credito::where('id_persona', $id)->firstOrFail()->id_tipo_moneda;
        if ($gg_tipo_moneda == 2) {
            $gg_icredito = Credito::where('id_persona', $id)->firstOrFail()->id_credito;
            $gge_cambio = TipoCambio::where('id_credito', $gg_icredito)->count();
            if ($gge_cambio == 0) {
                alert()->info('Info', 'Registre tipo de cambio')->showConfirmButton();
                return redirect('oficial/dashboard/');
            }
        }
        $endeudamiento_actual = $this->endeudamientoActual($id); //con la funcion para controlar division entre cero
        $monto_solicitado = Credito::where('id_credito', Session::get('id_credito'))->firstOrFail()->monto_solicitado;
        $endeudamiento_con_este_credito = $this->endeudamientoConEsteCredito($id);
        $pendeudamiento_actual = PuntajeRepository::f_endeudamiento_actual($endeudamiento_actual);
        $pendeudamiento_con_este_credito = PuntajeRepository::f_endeudamiento_con_credito($endeudamiento_con_este_credito);
        //calculo total de c2
        $total_c2 = $pendeudamiento_actual + $pendeudamiento_con_este_credito;
        $contador_c2 = ContadorC2Repository::contador_c2($endeudamiento_actual, $endeudamiento_con_este_credito);
        if ($contador_c2 == 0) {
            $porcentaje_c2 = 0;
        } else {
            $porcentaje_c2 = ($total_c2 * 15) / $contador_c2;
        }

        //-----------------CALCULO DE C3
        /*---------------
        TABLAS QUE INTERVIENEN
        ingreso mensual
        ---------------*/

        $c3_sum_eval = PuntajeRepository::cobertura_cuota($this->coverturaCuotaIngreso($id)) + PuntajeRepository::gasto_anterior($this->gastosIngresosAnterior($id)) + PuntajeRepository::gasto_actual($this->gastosIngresosActual($id));
        $contador_c3 = ContadorC3Repository::contador_c3($this->coverturaCuotaIngreso($id), $this->gastosIngresosAnterior($id), $this->gastosIngresosActual($id));
        if ($contador_c3 == 0) {
            $porcentaje_c3 = 0;
        } else {
            $porcentaje_c3 = ($c3_sum_eval * 50) / $contador_c3;
        }

        //dd($c3_sum_eval);

        //--------Calculo c4-----------
        $ingresos_fijos_mensuales = $this->totalIngresos($id);
        $ingresos_variables_mensuales = $this->ingresos_variables_mensuales($id);
        $ingresos_ultimo_mes = $ingresos_fijos_mensuales + $ingresos_variables_mensuales;
        $sum_ingresos_fijo_variable = PuntajeRepository::ingresos_condiciones($ingresos_fijos_mensuales) + PuntajeRepository::ingresos_condiciones($ingresos_variables_mensuales);
        $c4_sum_eval = $sum_ingresos_fijo_variable + PuntajeRepository::ingresos_condiciones($ingresos_ultimo_mes);
        $contador_c4 = ContadorC4Repository::contador_c4($ingresos_fijos_mensuales, $ingresos_variables_mensuales, $ingresos_ultimo_mes);
        if ($contador_c4 == 0) {
            $porcentaje_c4 = 0;
        } else {
            $porcentaje_c4 = ($c4_sum_eval * 5) / $contador_c4;
        }
        //--------Fin c4--------------
        //---------Calculo c5 ---------
        //error registro vacio de garantia begin
        if ($this->garantiaC5_1($id) == 0) {
            $tipoGarantia1 = "";
        } else {
            $tipoGarantia1 = TipoGarantia::where('id_tipo_garantia', $this->garantiaC5_1($id))->firstOrFail()->tipo_garantia;
        }

        if ($this->garantiaC5_2($id) == 0) {
            $tipoGarantia2 = "";
        } else {
            $tipoGarantia2 = TipoGarantia::where('id_tipo_garantia', $this->garantiaC5_2($id))->firstOrFail()->tipo_garantia;
        }
        //error de registro vacio de garantia end

        $c5_sum_eval_1 = PuntajeRepository::garantias($this->garantiaC5_1($id));
        $c5_sum_eval_2 = PuntajeRepository::garantias($this->garantiaC5_2($id));
        $total_c5 = $c5_sum_eval_1 + $c5_sum_eval_2;
        $contador_c5 = ContadorC5Repository::contador_c5($this->garantiaC5_1($id), $this->garantiaC5_2($id));

        if ($contador_c5 == 0) {
            $porcentaje_c5 = 0;
        } else {
            $porcentaje_c5 = ($total_c5 * 5) / $contador_c5;
        }

        //--------Fin  c5-----------
        //$puntaje_c5=$this->garantias($);
        //--------Eval Final
        $puntaje_scoring = $porcentaje_c1 + $porcentaje_c2 + $porcentaje_c3 + $porcentaje_c5 + $porcentaje_c4;
        $equivalencia_80 = ($puntaje_scoring * 80) / 100;
        $probabilidad_impago = 0.1;
        $equivalencia_20 = ((1 - $probabilidad_impago) * 0.2) * 100;
        $riesgo_crediticio = ($equivalencia_20 + $equivalencia_80);

//tipo de riesgo crediticio
        $tipo_riesgo = PuntajeRepository::tipoRiesgo($riesgo_crediticio);
        $recomendacion = PuntajeRepository::recomendacion($riesgo_crediticio);

        return view('oficial.scor.scor')
            ->with(compact('persona', 'credito', 'direccion', 'capacidad_pago12'))
            ->with('tipo_credito', $tipo_credito)
            ->with('edad', $edad)
            ->with('tipo_vivienda', $tipo_vivienda)
            ->with('tiempo_residencia', $tiempo_residencia)
            ->with('ptipo_residencia', $ptipo_residencia)
            ->with('ptiempo_residencia', $ptiempo_residencia)
            ->with('total_residencia', $total_residencia)
            //refactor
            ->with('contador_c1', $contador_c1)
            ->with('tiempo_de_trabajo', $this->tiempoTrabajoActividad($id))
            ->with('ptiempo_de_trabajo', PuntajeRepository::tiempoNegocio($this->tiempoTrabajoActividad($id)))
            ->with('tiempo_de_trabajo_empresa', $this->tiempoTrabajoEmpresa($id))
            ->with('ptiempo_de_trabajo_empresa', PuntajeRepository::tiempoNegocio($this->tiempoTrabajoEmpresa($id)))
            ->with('total_tiempo_negocio', $total_tiempo_negocio) //total tiempo de negocio
            //Experiencia crediticia
            ->with('experiencia_cre_dias', $this->experienciaCrediticia($id))
            ->with('penultima_experiencia_cre_dias', $this->penultima_experienciaCrediticia($id))
            ->with('ppenultima_experiencia_cre_dias', PuntajeRepository::experiencia_cre_ultimo($this->penultima_experienciaCrediticia($id)))
            ->with('pexperiencia_cre_dias', PuntajeRepository::experiencia_cre_ultimo($this->experienciaCrediticia($id)))
            ->with('total_experiencia_cre', $total_experiencia_crediticia)

            //redondeo a dos decimales formula round(valor_float * 100) / 100
            //total c1
            ->with('total_c1', $total_c1)
            ->with('porcentaje_c1', round($porcentaje_c1 * 100) / 100)
            //CALCULO DE C2
            ->with('endeudamiento_actual', round($endeudamiento_actual * 100) / 100)
            ->with('endeudamiento_con_este_credito', round($endeudamiento_con_este_credito * 100) / 100)
            ->with('pendeudamiento_actual', $pendeudamiento_actual)
            ->with('pendeudamiento_con_este_credito', $pendeudamiento_con_este_credito)
            ->with('total_c2', $total_c2)
            ->with('porcentaje_c2', round($porcentaje_c2 * 100) / 100)
            ->with('contador_c2', $contador_c2)
            //CALCULO DE C3
            ->with('covertura', round($this->coverturaCuotaIngreso($id) * 100) / 100)
            ->with('gastos_anterior', round($this->gastosIngresosAnterior($id) * 100) / 100)
            ->with('gastos_actual', round($this->gastosIngresosActual($id) * 100) / 100)
            ->with('contador_c3', $contador_c3)
            //c3 evaluado
            ->with('covertura_eval', PuntajeRepository::cobertura_cuota($this->coverturaCuotaIngreso($id)))
            ->with('gastos_anterior_eval', PuntajeRepository::gasto_anterior($this->gastosIngresosAnterior($id)))
            ->with('gastos_actual_eval', PuntajeRepository::gasto_actual($this->gastosIngresosActual($id)))
            ->with('c3_sum_eval', $c3_sum_eval)
            ->with('porcentaje_c3', round($porcentaje_c3 * 100) / 100)

            //c4 inicio
            ->with('ingresos_fijos_mensuales', round($ingresos_fijos_mensuales * 100) / 100)
            ->with('eval_ingresos_fijos_mensuales', PuntajeRepository::ingresos_condiciones($ingresos_fijos_mensuales))
            ->with('ingresos_variables_mensuales', round($ingresos_variables_mensuales * 100) / 100)
            ->with('eval_ingresos_variables_mensuales', PuntajeRepository::ingresos_condiciones($ingresos_variables_mensuales))
            ->with('ingresos_ultimo_mes', round($ingresos_ultimo_mes * 100) / 100)
            ->with('eval_ingresos_ultimo_mes', PuntajeRepository::ingresos_condiciones($ingresos_ultimo_mes))
            ->with('sum_ingresos_fijo_variable', $sum_ingresos_fijo_variable)
            ->with('c4_sum_eval', $c4_sum_eval)
            ->with('porcentaje_c4', round($porcentaje_c4 * 100) / 100)
            ->with('contador_c4', $contador_c4)
            //c4 fin

            //C5 --------------
            ->with('tipoGarantia1', $tipoGarantia1)
            ->with('tipoGarantia2', $tipoGarantia2)
            ->with('c5_sum_eval_1', $c5_sum_eval_1)
            ->with('c5_sum_eval_2', $c5_sum_eval_2)
            ->with('total_c5', $total_c5)
            ->with('contador_c5', $contador_c5)
            ->with('porcentaje_c5', round($porcentaje_c5 * 100) / 100)

            //Eval final
            ->with('puntaje_scoring', round($puntaje_scoring * 100) / 100)
            ->with('equivalencia_80', round($equivalencia_80 * 100) / 100)
            ->with('probabilidad_impago', $probabilidad_impago * 100)
            ->with('equivalencia_20', $equivalencia_20)
            ->with('riesgo_crediticio', round($riesgo_crediticio * 100) / 100)
            ->with('tipo_riesgo', $tipo_riesgo)
            ->with('recomendacion', $recomendacion);
    }
//FUNCIONES DE C1
    public function tiempoTrabajoEmpresa($id)
    {
        //Datos economicos Depenciente
        $if_exist_codeudor = DatosEmpresa::where('id_persona', $id)->exists();
        if ($if_exist_codeudor) {
            $now = Carbon::now();
            $datos_empresa = DatosEmpresa::where('id_persona', $id)->firstOrFail();
            $tiempo_de_trabajo_empresa = Carbon::parse($datos_empresa->antiguedad_empresa)->diffInMonths($now);
            return $tiempo_de_trabajo_empresa;
        } else {
            return 0;
        }
    }

    public function tiempoTrabajoActividad($id)
    {
        //Datos economicos Depenciente
        $if_exist_codeudor = ActividadEconomica::where('id_persona', $id)->count();
        if ($if_exist_codeudor > 0) {
            $now = Carbon::now();
            $actividad_economica = ActividadEconomica::where('id_persona', $id)->firstOrFail();
            $tiempo_de_trabajo = Carbon::parse($actividad_economica->antiguedad_trabajo_ae)->diffInMonths($now);
            return $tiempo_de_trabajo;
        } else {
            return 0;
        }
    }

    public function experienciaCrediticia($id)
    {
        $if_exist_codeudor = ReporteBuro::where('id_persona', $id)->count();
        if ($if_exist_codeudor > 0) {

            $tiempo_maximo_mora = ReporteBuro::where('id_persona', $id)->firstOrFail()->tiempo_maximo_mora;
            return $tiempo_maximo_mora;
        } else {
            return 0;
        }
    }

    public function penultima_experienciaCrediticia($id)
    {
        $if_exist_codeudor = ReporteBuro::where('id_persona', $id)->count();

        if ($if_exist_codeudor >= 2) {
            $reporte = ReporteBuro::where('id_persona', $id)->get()->last();
            return $reporte->tiempo_maximo_mora;
        } else {
            return 0;
        }
    }

//END FUNCIONES C1
    //FUNCIONES NECESARIAS PARA EL CALCULO DE LA C2
    public function total_activos($id)
    {
        $if_exist_caja = EfectivoCaja::where('id_persona', $id)->count();
        if ($if_exist_caja > 0) {
            $total_efectivo = DB::table('efectivos_caja')->where('id_persona', $id)->sum('caja');
        } else {
            $total_efectivo = 0;
        }

        $if_exist_otro = OtroActivo::where('id_persona', $id)->count();
        if ($if_exist_otro > 0) {
            $total_otro = DB::table('otros_activos')->where('id_persona', $id)->sum('total');
        } else {
            $total_otro = 0;
        }

        $if_exist = DepositoBancario::where('id_persona', $id)->count();
        if ($if_exist > 0) {
            $total_depositos_bancarios = DB::table('deposito_bancario')->where('id_persona', $id)->sum('saldo');
        } else {
            $total_depositos_bancarios = 0;
        }

        $if_exist_d = CuentasDocumentosCobrar::where('id_persona', $id)->count();
        if ($if_exist_d > 0) {
            $total_cuentas_cobrar = DB::table('cuentas_documentos_cobrar')->where('id_persona', $id)->sum('saldo');
        } else {
            $total_cuentas_cobrar = 0;
        }

        $if_exist_i = InversionesFinancieras::where('id_persona', $id)->count();
        if ($if_exist_i > 0) {
            $total_inversiones = DB::table('inversiones_financieras')->where('id_persona', $id)->sum('valor_mercado');
        } else {
            $total_inversiones = 0;
        }

        $if_exist_ma = MaquinariaEquipo::where('id_persona', $id)->count();
        if ($if_exist_ma) {
            $total_maquinaria = DB::table('maquinaria_equipo')->where('id_persona', $id)->sum('total');
        } else {
            $total_maquinaria = 0;
        }

        $if_exist_in = InventarioMercaderia::where('id_persona', $id)->count();
        if ($if_exist_in > 0) {
            $total_mercaderia_inventarios = DB::table('inventario_mercaderia')->where('id_persona', $id)->sum('total');
        } else {
            $total_mercaderia_inventarios = 0;
        }

        $if_exist_pro = Inmueble::where('id_persona', $id)->count();
        if ($if_exist_pro > 0) {
            $total_propiedades = DB::table('inmueble')->where('id_persona', $id)->sum('valor');
        } else {
            $total_propiedades = 0;
        }

        $if_exist_ve = Vehiculo::where('id_persona', $id)->count();
        if ($if_exist_ve > 0) {
            $total_vehiculos = DB::table('vehiculo')->where('id_persona', $id)->sum('valor');
        } else {
            $total_vehiculos = 0;
        }

        $if_exist_bienes = BienesHogar::where('id_persona', $id)->count();
        if ($if_exist_bienes > 0) {
            $total_bienes = DB::table('bienes_hogar')->where('id_persona', $id)->sum('valor');
        } else {
            $total_bienes = 0;
        }

//sumatoria del total de pasivos
        $total_activos = $total_otro + $total_efectivo + $total_depositos_bancarios + $total_cuentas_cobrar + $total_inversiones + $total_maquinaria + $total_mercaderia_inventarios + $total_propiedades + $total_vehiculos + $total_bienes;

        return $total_activos;
    }

    public function total_pasivos($id)
    {
        $if_exist = PrestamoBancario::where('id_persona', $id)->count();

        if ($if_exist > 0) {
            $total_prestamos_bancarios = DB::table('prestamo_bancario')->where('id_persona', $id)->sum('saldo');
        } else {
            $total_prestamos_bancarios = 0;
        }
        $if_exist_1 = CuentasPorPagar::where('id_persona', $id)->count();
        if ($if_exist_1 > 0) {
            $total_cuentas_por_pagar = DB::table('cuentas_por_pagar')->where('id_persona', $id)->sum('saldo');

        } else {
            $total_cuentas_por_pagar = 0;
        }

        $total_pasivos = $total_prestamos_bancarios + $total_cuentas_por_pagar;
        return $total_pasivos;
    }

//Endeudamiento Actual
    public function endeudamientoActual($id)
    {
        if ($this->total_activos($id) == 0) {
            return 0;
        } else {
            $endeudamiento_actual = ($this->total_pasivos($id) / $this->total_activos($id)) * 100;
            return $endeudamiento_actual;
        }

    }

    public function endeudamientoConEsteCredito($id)
    {
        if ($this->total_activos($id) == 0) {
            return 0;
        } else {
            $monto_solicitado = Credito::where('id_credito', Session::get('id_credito'))->firstOrFail()->monto_solicitado;
            $tipo_moneda = Credito::where('id_persona', $id)->firstOrFail()->id_tipo_moneda;
            if ($tipo_moneda == 2) {
                $icredito = Credito::where('id_persona', $id)->firstOrFail()->id_credito;
                $e_cambio = TipoCambio::where('id_credito', $icredito)->count();
                if ($e_cambio > 0) {
                    $tipo_cambio = TipoCambio::where('id_credito', $icredito)->firstOrFail()->cambio;
                    $endeudamiento_con_este_credito = (($this->total_pasivos($id) + ($monto_solicitado * $tipo_cambio)) / $this->total_activos($id)) * 100;
                    return $endeudamiento_con_este_credito;
                }
            } else {
                $endeudamiento_con_este_credito = (($this->total_pasivos($id) + $monto_solicitado) / $this->total_activos($id)) * 100;
                return $endeudamiento_con_este_credito;
            }

        }

    }
    //FUNCIONES PARA EL CALCULO DE LA C3
    public function totalIngresos($id)
    {
        $existe_ingreso = IngresoMensual::where('id_persona', $id)->exists();
        if ($existe_ingreso) {
            $total_ingreso_mensual_solicitante = DB::table('ingreso_mensual')->where('id_persona', $id)->avg('total_ingreso');
            return $total_ingreso_mensual_solicitante;
        } else {
            return 0;
        }

    }
    public function vPrecioTotal($id)
    {
        $if_exist_registros = VentaComercializacionProducto::where('id_persona', $id)->exists();
        if ($if_exist_registros) {
            $total_venta_comercializacion = DB::table('venta_comercializacion_productos')->where('id_persona', $id)->sum('v_precio_total');
            return $total_venta_comercializacion;
        } else {
            return 0;
        }
    }

    public function cCostoTotal($id)
    {
        $if_exist_registros = VentaComercializacionProducto::where('id_persona', $id)->count();
        if ($if_exist_registros >= 1) {
            $total_venta_comercializacion = DB::table('venta_comercializacion_productos')->where('id_persona', $id)->sum('c_costo_total');
            return $total_venta_comercializacion;
        } else {
            return 0;
        }

    }

    public function manoObra($id)
    {
        $if_exist_registros = VentaComercializacionProducto::where('id_persona', $id)->exists();
        if ($if_exist_registros) {
            $total_mano_obra = DB::table('mano_obra_mensual')->where('id_persona', $id)->sum('total_mano_obra');
            return $total_mano_obra;
        } else {
            return 0;
        }
    }

    public function gastosOperativos($id)
    {
        $if_exist_registros = GastosOperativosComercializacion::where('id_persona', $id)->exists();
        if ($if_exist_registros) {
            $total_gastos_operativos = DB::table('gastos_operativos_comercializacion')
                ->select(DB::raw('sum(COALESCE(combustible,0)+COALESCE(deposito_almacen,0)+COALESCE(energia_electrica,0)+COALESCE(agua,0)+COALESCE(gas,0)+COALESCE(telefono,0)+COALESCE(impuestos,0)+COALESCE(alquiler,0)+COALESCE(cuidado_sereno,0)+COALESCE(transporte,0)+COALESCE(mantenimiento,0)+COALESCE(publicidad,0)+COALESCE(otros,0))'))
                ->where('id_persona', $id)
                ->get();
            return $total_gastos_operativos[0]->sum;
        } else {
            return 0;
        }
    }

//funcion del calculo de la utilidad para la capacidad de pago
    public function utilidadCapacidadPago($id)
    {
        $if_exist_registros = CapacidadPago::where('id_persona', $id)->count();

        if ($if_exist_registros >= 1) {
            //$porcentaje=CapacidadPago::where('id_persona',$id)->firstOrFail()->porcentaje;//obtencion id_credito
            //$tcreditoporcentaje=$valor*$porcentaje;//segun 25% o 40%

            $amortizacion = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;
            $importe_ultimo_pago = PrestamoBancario::where('id_persona', $id)->firstOrFail()->importe_ultimo_pago;
            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);

            //calculo del  total de egresos
            $total_egresos = $amortizacion + $importe_ultimo_pago + $total_cuentas_por_pagar + $total_gastos_familiares;
            return $total_egresos;
        } else {
            return 0;
        }
    }

//funciones para calcular total egresos
    public function cuentasPorPagar($id)
    {
        $if_exist_registros = CuentasPorPagar::where('id_persona', $id)->exists();
        if ($if_exist_registros) {
            $total_cuentas_por_pagar = DB::table('cuentas_por_pagar')->where('id_persona', $id)->sum('cuota_mensual');
            return $total_cuentas_por_pagar;
        } else {
            return 0;
        }
    }

    public function gastosFamiliares($id)
    {
        $if_exist_registros = GastosFamiliares::where('id_persona', $id)->exists();
        if ($if_exist_registros) {
            $total_gastos_familiares = DB::table('gastos_familiares')
                ->select(DB::raw('sum(COALESCE(alimentacion,0)+COALESCE(energia_electrica,0)+COALESCE(agua,0)+COALESCE(telefono,0)+COALESCE(gas,0)+COALESCE(impuestos,0)+COALESCE(alquileres,0)+COALESCE(educacion,0)+COALESCE(transporte,0)+COALESCE(salud,0)+COALESCE(empleada,0)+COALESCE(diversion,0)+COALESCE(vestimenta,0)+COALESCE(otros,0))'))
                ->where('id_persona', $id)
                ->get();
            return $total_gastos_familiares[0]->sum;
        } else {
            return 0;
        }
    }

    public function margenAhorro($id)
    {
        $margenAhorro = $this->utilidadOperativa($id) - $this->utilidadCapacidadPago($id);
        return $margenAhorro;
    }

    public function utilidadOperativa($id)
    {
        $ingresos = ($this->totalIngresos($id) + $this->vPrecioTotal($id)) - ($this->cCostoTotal($id) + $this->manoObra($id) + $this->gastosOperativos($id));
        return $ingresos;
    }
//calculo de cobertura cuota ingreso
    public function coverturaCuotaIngreso($id)
    {
        $if_exist_cap = CapacidadPago::where('id_persona', $id)->exists();
        if ($if_exist_cap) {
            $amortizacion = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;

            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);
            //calculo del  total de egresos
            $total_egresos = $total_cuentas_por_pagar + $total_gastos_familiares + $this->amortizacionPrestamo($id);
            //calculo de covertura
            $covertura = ($this->utilidadOperativa($id) - $total_egresos) / $amortizacion;
            //$covertura=(6627.07-2711)/673;
            return $covertura * 100;

        } else {
            return 0;
        }

    }

    //funcion para obtener amortizacion credito de la tabla prestamos
    public function amortizacionPrestamo($id)
    {
        $suma_amortizacion = DB::table('prestamo_bancario')->where('id_persona', Session::get('id_persona'))->sum('importe_ultimo_pago');
        return $suma_amortizacion;
    }

    public function gastosIngresosAnterior($id)
    {
        if ($this->utilidadOperativa($id) == 0) {
            return 0;
        } else {
            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);
            //calculo del  total de egresos
            $total_egresos = $total_cuentas_por_pagar + $total_gastos_familiares + $this->amortizacionPrestamo($id);
            //calculo de covertura
            $gastos_ingresos_anterior = $total_egresos / $this->utilidadOperativa($id);
            // pruebas $gastos_ingresos_anterior=(2711)/6627;
            return $gastos_ingresos_anterior * 100;
        }

    }

    public function gastosIngresosActual($id)
    {
        if ($this->utilidadOperativa($id) == 0) {
            return 0;
        } else {
            $if_exist_registros = CapacidadPago::where('id_persona', $id)->exists();
            if ($if_exist_registros) {
                $amortizacion = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;
            } else {
                $amortizacion = 0;
            }
            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);
            //calculo del  total de egresos
            $total_egresos = $amortizacion + $total_cuentas_por_pagar + $total_gastos_familiares + $this->amortizacionPrestamo($id);
            //calculo de covertura
            $gastos_ingresos_actual = $total_egresos / $this->utilidadOperativa($id); // $gastos_ingresos_actual=3384/6627;

            return $gastos_ingresos_actual * 100;
        }

    }

//C4 ---------------------------------------- Begin functions
    public function ingresos_variables_mensuales($id)
    {
        $existe_venta = VentaComercializacionProducto::where('id_persona', $id)->exists();
        if ($existe_venta) {
            $precio_total = DB::table('venta_comercializacion_productos')->where('id_persona', $id)->sum('v_precio_total');
            $compras_precio_total = DB::table('venta_comercializacion_productos')->where('id_persona', $id)->sum('c_costo_total');
            $suma_total = $precio_total - ($compras_precio_total + $this->manoObra($id) + $this->gastosOperativos($id));
            return $suma_total;
        } else {
            return 0;
        }
    }

//c4 end

//Begin c5
    public function garantiaC5_1($id)
    {
        $if_exist_credito = Credito::where('id_persona', $id)->exists();
        if ($if_exist_credito) {
            $idCredito = Credito::where('id_persona', $id)->firstOrFail()->id_credito;
            $if_exist_garantia = Garantia::where('id_credito', $idCredito)->exists();
            if ($if_exist_garantia) {
                $id_tipoGarantia = Garantia::where('id_credito', $idCredito)->firstOrFail()->id_tipo_garantia;
                return $id_tipoGarantia;
            } else {
                return 0; //rev
            }
        }
        return 0;
    }

    public function garantiaC5_2($id)
    {
        $if_exist_credito = Credito::where('id_persona', $id)->exists();
        if ($if_exist_credito) {
            $idCredito = Credito::where('id_persona', $id)->firstOrFail()->id_credito;
            $cont_exist_garantia = Garantia::where('id_credito', $idCredito)->count();
            if ($cont_exist_garantia >= 2) {
                $garantia = Garantia::where('id_credito', $idCredito)->get()->last();
                return $garantia->id_tipo_garantia;
            } else {
                return 0; //rev
            }
        }
        return 0;
    }

//End c5

//error c2
    public function error_c2($valor)
    {
        if ($valor == 0) {
            return "llenar activos";
        } else {
            return $valor;
        }
    }

}
