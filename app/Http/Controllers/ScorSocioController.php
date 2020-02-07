<?php

namespace sis5cs\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use sis5cs\ActividadEconomica;
use sis5cs\CapacidadPago;
use sis5cs\Codeudor;
use sis5cs\Conyugue;
use sis5cs\Credito;
use sis5cs\CuentasPorPagar;
use sis5cs\DatosEmpresa;
use sis5cs\Direccion;
use sis5cs\Garantia;
use sis5cs\GastosFamiliares;
use sis5cs\GastosOperativosComercializacion;

//c3
use sis5cs\Persona;
use sis5cs\PrestamoBancario;
use sis5cs\ReporteBuro;
use sis5cs\TipoCredito;
use sis5cs\TipoGarantia;

//c5
use sis5cs\TipoVivienda;
use sis5cs\VentaComercializacionProducto;

class ScorSocioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            /*$calculo=new Calculo5csRepository(5);
            dd($calculo->tipo_residencia(1));*/
            $personas = Persona::All();
            return view('scor.index')->with(compact('personas'));
        } //busqueda por nombre y ci
        /*$clientes=Cliente::paginate(7);
    return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }

    public function scor($id)
    {
        $persona = Persona::find($id);
        //tabla credito
        $credito = Credito::where('id_persona', $id)->firstOrFail();
        $tipo_credito = TipoCredito::where('id_tcredito', $credito->id_tcredito)->firstOrFail()->tipo_credito;
        $edad = Carbon::parse($persona->fec_nac)->age; // 1990-10-25
        //Tabla direccion
        $direccion = Direccion::where('id_persona', $id)->firstOrFail();
        $tipo_vivienda = TipoVivienda::where('id_tipo_vivienda', $direccion->id_tipo_vivienda)->firstOrFail()->tipo_vivienda;

        //creación de
        $now = Carbon::now();
        $tiempo_residencia = Carbon::parse($direccion->tiempo_residencia)->diffInMonths($now);
        //cálculo de puntaje
        $ptipo_residencia = $this->tipo_residencia($direccion->id_tipo_vivienda);
        $ptiempo_residencia = $this->tiempo_residencia($tiempo_residencia);
        $total_residencia = $ptipo_residencia + $ptiempo_residencia;
        //datos economicos independiente
        $datos_empresa = DatosEmpresa::where('id_persona', $id)->firstOrFail();
        $tiempo_de_trabajo_empresa = Carbon::parse($datos_empresa->antiguedad_en_cargo)->diffInMonths($now);
        $ptiempo_de_trabajo_empresa = $this->tiempoNegocio($tiempo_de_trabajo_empresa);
        //datos de actividad economica (independiente)
        $actividad_economica = ActividadEconomica::where('id_persona', $id)->firstOrFail();
        $tiempo_de_trabajo = Carbon::parse($actividad_economica->antiguedad_trabajo_ae)->diffInMonths($now);
        $ptiempo_de_trabajo = $this->tiempoNegocio($tiempo_de_trabajo);
        //calculo total de tiempo de negocio dependiente independiente
        $total_tiempo_negocio = $ptiempo_de_trabajo + $ptiempo_de_trabajo_empresa;

        //experiencia crediticia
        $reporte_buro = ReporteBuro::where('id_persona', $id)->firstOrFail();
        $experiencia_cre_dias = Carbon::parse($reporte_buro->tiempo_maximo_mora)->diffInDays($now);
        $pexperiencia_cre_dias = $this->experiencia_cre_ultimo($experiencia_cre_dias);
        //calculo experiencia crediticia
        $total_experiencia_cre = $pexperiencia_cre_dias;

        //calculo total de c1
        $total_c1 = $total_residencia + $total_tiempo_negocio + $total_experiencia_cre;
        //porcentaje de c1
        $porcentaje_c1 = ($total_c1 * 25) / 50;

        //CÁLCULO DE C2

        //Calculo de endeudamiento actual
        $endeudamiento_actual = round(($this->total_pasivos($id) / $this->total_activos($id)) * 100);
        $monto_solicitado = Credito::where('id_persona', $id)->firstOrFail()->monto_solicitado;
        $endeudamiento_con_este_credito = round((($this->total_pasivos($id) + $monto_solicitado) / $this->total_activos($id)) * 100);

        $pendeudamiento_actual = $this->f_endeudamiento_actual($endeudamiento_actual);

        $pendeudamiento_con_este_credito = $this->f_endeudamiento_con_credito($endeudamiento_con_este_credito);

        //calculo total de c2
        $total_c2 = $pendeudamiento_actual + $pendeudamiento_con_este_credito;
        $porcentaje_c2 = ($total_c2 * 15) / 20;

        //-----------------CALCULO DE C3
        /*---------------
        TABLAS QUE INTERVIENEN
        ingreso mensual
        ---------------*/
        $c3_sum_eval = $this->cobertura_cuota($this->coverturaCuotaIngreso($id)) + $this->gasto_anterior($this->gastosIngresosAnterior($id)) + $this->gasto_actual($this->gastosIngresosActual($id));
        $porcentaje_c3 = ($c3_sum_eval * 50) / 30;

        //--------Calculo c4-----------
        $ingresos_fijos_mensuales = $this->total_ingresos_mensuales_solicitante($id);
        $ingresos_variables_mensuales = $this->ingresos_variables_mensuales($id);
        $ingresos_ultimo_mes = $ingresos_fijos_mensuales + $ingresos_variables_mensuales;

        $sum_ingresos_fijo_variable = $this->ingresos_condiciones($ingresos_fijos_mensuales) + $this->ingresos_condiciones($ingresos_variables_mensuales);
        $c4_sum_eval = $sum_ingresos_fijo_variable + $this->ingresos_condiciones($ingresos_ultimo_mes);
        $porcentaje_c4 = ($c4_sum_eval * 5) / 30;

        //--------Fin c4--------------

        //---------Calculo c5 ---------
        //--------Fin  c5-----------
        $idCredito = Credito::where('id_persona', $id)->firstOrFail()->id_credito;
        $id_tipoGarantia = Garantia::where('id_credito', $idCredito)->firstOrFail()->id_tipo_garantia;
        $tipoGarantia = TipoGarantia::where('id_tipo_garantia', $id_tipoGarantia)->firstOrFail()->tipo_garantia;
        $c5_sum_eval = $this->garantias($id_tipoGarantia);
        $porcentaje_c5 = ($c5_sum_eval * 5) / 10;

        //$puntaje_c5=$this->garantias($);
        //--------Eval Final
        $puntaje_scoring = $porcentaje_c1 + $porcentaje_c2 + $porcentaje_c3 + $porcentaje_c5 + $porcentaje_c4;
        $equivalencia_80 = ($puntaje_scoring * 80) / 100;
        $probabilidad_impago = 0.1;
        $equivalencia_20 = (1 - $probabilidad_impago) * 0.2;
        $riesgo_crediticio = $equivalencia_20 + $equivalencia_80;

//tipo de riesgo crediticio
        $tipo_riesgo = $this->tipoRiesgo($riesgo_crediticio);
        $recomendacion = $this->recomendacion($riesgo_crediticio);

        return view('scor.scor')
            ->with(compact('persona', 'credito', 'direccion'))
            ->with('tipo_credito', $tipo_credito)
            ->with('edad', $edad)
            ->with('tipo_vivienda', $tipo_vivienda)
            ->with('tiempo_residencia', $tiempo_residencia)
            ->with('ptipo_residencia', $ptipo_residencia)
            ->with('ptiempo_residencia', $ptiempo_residencia)
            ->with('total_residencia', $total_residencia)
            ->with('tiempo_de_trabajo', $tiempo_de_trabajo)
            ->with('ptiempo_de_trabajo', $ptiempo_de_trabajo)
            ->with('tiempo_de_trabajo_empresa', $tiempo_de_trabajo_empresa)
            ->with('ptiempo_de_trabajo_empresa', $ptiempo_de_trabajo_empresa)
            ->with('total_tiempo_negocio', $total_tiempo_negocio)
            ->with('experiencia_cre_dias', $experiencia_cre_dias)
            ->with('pexperiencia_cre_dias', $pexperiencia_cre_dias)
            ->with('total_experiencia_cre', $total_experiencia_cre)
            //total c1
            ->with('total_c1', $total_c1)
            ->with('porcentaje_c1', $porcentaje_c1)
            //CALCULO DE C2
            ->with('endeudamiento_actual', $endeudamiento_actual)
            ->with('endeudamiento_con_este_credito', $endeudamiento_con_este_credito)
            ->with('pendeudamiento_actual', $pendeudamiento_actual)
            ->with('pendeudamiento_con_este_credito', $pendeudamiento_con_este_credito)
            ->with('total_c2', $total_c2)
            ->with('porcentaje_c2', $porcentaje_c2)
            //CALCULO DE C3
            ->with('covertura', $this->coverturaCuotaIngreso($id))
            ->with('gastos_anterior', $this->gastosIngresosAnterior($id))
            ->with('gastos_actual', $this->gastosIngresosActual($id))
            //c3 evaluado
            ->with('covertura_eval', $this->cobertura_cuota($this->coverturaCuotaIngreso($id)))
            ->with('gastos_anterior_eval', $this->gasto_anterior($this->gastosIngresosAnterior($id)))
            ->with('gastos_actual_eval', $this->gasto_actual($this->gastosIngresosActual($id)))
            ->with('c3_sum_eval', $c3_sum_eval)
            ->with('porcentaje_c3', $porcentaje_c3)

            //c4 inicio
            ->with('ingresos_fijos_mensuales', $ingresos_fijos_mensuales)
            ->with('eval_ingresos_fijos_mensuales', $this->ingresos_condiciones($ingresos_fijos_mensuales))
            ->with('ingresos_variables_mensuales', $ingresos_variables_mensuales)
            ->with('eval_ingresos_variables_mensuales', $this->ingresos_condiciones($ingresos_variables_mensuales))
            ->with('ingresos_ultimo_mes', $ingresos_ultimo_mes)
            ->with('eval_ingresos_ultimo_mes', $this->ingresos_condiciones($ingresos_ultimo_mes))
            ->with('sum_ingresos_fijo_variable', $sum_ingresos_fijo_variable)
            ->with('c4_sum_eval', $c4_sum_eval)
            ->with('porcentaje_c4', $porcentaje_c4)

            //c4 fin

            //C5 --------------
            ->with('tipoGarantia', $tipoGarantia)
            ->with('c5_sum_eval', $c5_sum_eval)
            ->with('porcentaje_c5', $porcentaje_c5)

            //Eval final
            ->with('puntaje_scoring', $puntaje_scoring)
            ->with('equivalencia_80', $equivalencia_80)
            ->with('probabilidad_impago', $probabilidad_impago * 100)
            ->with('equivalencia_20', $equivalencia_20 * 100)
            ->with('riesgo_crediticio', $riesgo_crediticio)
            ->with('tipo_riesgo', $tipo_riesgo)
            ->with('recomendacion', $recomendacion)

        ;

    }
//FUNCIONES NECESARIAS PARA EL CALCULO DE LA C2
    public function total_activos($id)
    {
        $total_depositos_bancarios = DB::table('deposito_bancario')->where('id_persona', $id)->sum('saldo');
        $total_cuentas_cobrar = DB::table('cuentas_documentos_cobrar')->where('id_persona', $id)->sum('saldo');
        $total_inversiones = DB::table('inversiones_financieras')->where('id_persona', $id)->sum('valor_nominal');
        $total_maquinaria = DB::table('maquinaria_equipo')->where('id_persona', $id)->sum('total');
        $total_mercaderia_inventarios = DB::table('inventario_mercaderia')->where('id_persona', $id)->sum('precio_unitario');
        $total_propiedades = DB::table('inmueble')->where('id_persona', $id)->sum('valor');
        $total_vehiculos = DB::table('vehiculo')->where('id_persona', $id)->sum('valor');
        //sumatoria del total de pasivos
        $total_activos = $total_depositos_bancarios + $total_cuentas_cobrar + $total_inversiones + $total_maquinaria + $total_mercaderia_inventarios + $total_propiedades + $total_vehiculos;
        return $total_activos;
    }

    public function total_pasivos($id)
    {
        $total_prestamos_bancarios = DB::table('prestamo_bancario')->where('id_persona', $id)->sum('saldo');
        $total_cuentas_por_pagar = DB::table('cuentas_por_pagar')->where('id_persona', $id)->sum('saldo');
        $total_pasivos = $total_prestamos_bancarios + $total_cuentas_por_pagar;
        return $total_pasivos;
    }

    //FUNCIONES PARA EL CALCULO DE LA C3
    public function total_ingresos_mensuales_solicitante($id)
    {
        $total_ingreso_mensual_solicitante = DB::table('ingreso_mensual')->where('id_persona', $id)->avg('prestatario');
        return $total_ingreso_mensual_solicitante;
    }
    public function total_ingresos_mensuales_conyugue($id)
    {
        $if_exist_conyugue = Conyugue::where('conyugue', $id)->count(); //si existe conyugue
        if ($if_exist_conyugue >= 1) {
            $id_persona_conyugue = Conyugue::where('conyugue', $id)->firstOrFail()->id_persona; //seleccion de id_persona para el conyugue en caso de existir
            $total_ingreso_mensual_conyugue = DB::table('ingreso_mensual')->where('id_persona', $id_persona_conyugue)->avg('prestatario');
            return $total_ingreso_mensual_conyugue;
        } else {
            return 0;
        }
    }

    public function total_ingresos_mensuales_codeudores($id)
    {
        $if_exist_codeudor = Codeudor::where('codeudor', $id)->count();
        if ($if_exist_codeudor >= 1) {
            $id_persona_codeudor = Conyugue::where('conyugue', $id)->firstOrFail()->id_persona; //seleccion de id_persona para el codeudor en caso de existir
            $total_ingreso_mensual_codeudor = DB::table('ingreso_mensual')->where('id_persona', $id_persona_codeudor)->avg('prestatario');
            return $total_ingreso_mensual_codeudor;
        } else {
            return 0;
        }
    }

    public function vPrecioTotal($id)
    {
        $if_exist_registros = VentaComercializacionProducto::where('id_persona', $id)->count();
        if ($if_exist_registros >= 1) {
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
        $if_exist_registros = VentaComercializacionProducto::where('id_persona', $id)->count();
        if ($if_exist_registros >= 1) {
            $total_mano_obra = DB::table('mano_obra_mensual')->where('id_persona', $id)->sum('total_mano_obra');
            return $total_mano_obra;
        } else {
            return 0;
        }
    }

    public function gastosOperativos($id)
    {
        $if_exist_registros = GastosOperativosComercializacion::where('id_persona', $id)->count();
        if ($if_exist_registros >= 1) {
            $total_gastos_operativos = DB::table('gastos_operativos_comercializacion')
                ->select(DB::raw('sum(combustible+deposito_almacen+energia_electrica+agua+gas+telefono+impuestos+alquiler+cuidado_sereno+transporte+mantenimiento+publicidad+otros)'))
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
        $if_exist_registros = CuentasPorPagar::where('id_persona', $id)->count();
        if ($if_exist_registros >= 1) {
            $total_cuentas_por_pagar = DB::table('cuentas_por_pagar')->where('id_persona', $id)->sum('cuota_mensual');
            return $total_cuentas_por_pagar;
        } else {
            return 0;
        }
    }

    public function gastosFamiliares($id)
    {
        $if_exist_registros = GastosFamiliares::where('id_persona', $id)->count();
        if ($if_exist_registros >= 1) {
            $total_gastos_familiares = DB::table('gastos_familiares')
                ->select(DB::raw('sum(alimentacion+energia_electrica+agua+telefono+gas+impuestos+alquileres+educacion+transporte+salud+empleada+diversion+vestimenta+otros)'))
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
        $ingresos = $this->total_ingresos_mensuales_solicitante($id) + $this->total_ingresos_mensuales_conyugue($id) + $this->total_ingresos_mensuales_codeudores($id) + $this->vPrecioTotal($id) - $this->cCostoTotal($id) - $this->manoObra($id) + $this->gastosOperativos($id);
        return $ingresos;
    }
//calculo de cobertura cuota ingreso
    public function coverturaCuotaIngreso($id)
    {
        $if_exist_registros = CapacidadPago::where('id_persona', $id)->count();

        if ($if_exist_registros >= 1) {
            $amortizacion = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;
            $importe_ultimo_pago = PrestamoBancario::where('id_persona', $id)->firstOrFail()->importe_ultimo_pago;
            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);

            //calculo del  total de egresos
            $total_egresos = $importe_ultimo_pago + $total_cuentas_por_pagar + $total_gastos_familiares;
            //calculo de covertura
            $covertura = ($this->utilidadOperativa($id) - $total_egresos) / $amortizacion;
            //$covertura=(6627.07-2711)/673;
            return $covertura * 100;
        } else {
            return 0;
        }
    }

    public function gastosIngresosAnterior($id)
    {
        $if_exist_registros = CapacidadPago::where('id_persona', $id)->count();

        if ($if_exist_registros >= 1) {
            $amortizacion = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;
            $importe_ultimo_pago = PrestamoBancario::where('id_persona', $id)->firstOrFail()->importe_ultimo_pago;
            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);

            //calculo del  total de egresos
            $total_egresos = $importe_ultimo_pago + $total_cuentas_por_pagar + $total_gastos_familiares;
            //calculo de covertura
            $gastos_ingresos_anterior = $total_egresos / $this->utilidadOperativa($id);
            // pruebas $gastos_ingresos_anterior=(2711)/6627;
            return $gastos_ingresos_anterior * 100;
        } else {
            return 0;
        }
    }

    public function gastosIngresosActual($id)
    {
        $if_exist_registros = CapacidadPago::where('id_persona', $id)->count();

        if ($if_exist_registros >= 1) {
            $amortizacion = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;
            $importe_ultimo_pago = PrestamoBancario::where('id_persona', $id)->firstOrFail()->importe_ultimo_pago;
            $total_cuentas_por_pagar = $this->cuentasPorPagar($id);
            $total_gastos_familiares = $this->gastosFamiliares($id);

            //calculo del  total de egresos
            $total_egresos = $amortizacion + $importe_ultimo_pago + $total_cuentas_por_pagar + $total_gastos_familiares;
            //calculo de covertura
            $gastos_ingresos_actual = $total_egresos / $this->utilidadOperativa($id);
            // $gastos_ingresos_actual=3384/6627;

            return $gastos_ingresos_actual * 100;
        } else {
            return 0;
        }
    }

//C4 ---------------------------------------- Begin functions
    public function ingresos_variables_mensuales($id)
    {
        $precio_total = DB::table('venta_comercializacion_productos')->where('id_persona', $id)->sum('v_precio_total');

        $compras_precio_total = DB::table('venta_comercializacion_productos')->where('id_persona', $id)->sum('c_costo_total');

        $suma_total = $precio_total - $compras_precio_total - $this->manoObra($id) - $this->gastosOperativos($id);
        if ($suma_total < 0) {
            return 0;
        } else {

            return $suma_total;
        }
    }

//c4 end

    //FUNCIONES PARA LA CALIFICACION DE LAS 5CS---------------------------------------------------------------
    public function tipo_residencia($valor)
    {
        switch ($valor) {
            case 1:
                return 10;
                break;

            case 2:
                return 9;
                break;

            case 3:
                return 7;
                break;

            case 4:
                return 8;
                break;

            case 5:
                return 5;
                break;

            case 6:
                return 3;
                break;

            case 7:
                return 3;
                break;
            default:
                return 'error';
                break;
        }
    }
    //tomar en cuenta cuando tipo de vivienda es propia
    public function tiempo_residencia($valor)
    {
        if ($valor >= 1 && $valor <= 6) {
            return 1;
        } else {
            if ($valor >= 7 && $valor <= 12) {
                return 3;
            } else {
                if ($valor >= 13 && $valor <= 24) {
                    return 4;
                } else {
                    if ($valor >= 25 && $valor <= 36) {
                        return 7;
                    } else {
                        if ($valor >= 37) {
                            return 8;
                        }
                    }
                }
            }
        }
    }

//Negocio
    public function tiempoNegocio($valor)
    {
        if ($valor >= 0 && $valor <= 12) {
            return 2;
        } else {
            if ($valor >= 13 && $valor <= 24) {
                return 3;
            } else {
                if ($valor >= 25 && $valor <= 35) {
                    return 6;
                } else {
                    if ($valor >= 36 && $valor <= 59) {
                        return 8;
                    } else {
                        if ($valor >= 60) {
                            return 10;
                        }
                    }
                }
            }
        }
    }

    public function experiencia_cre_penultimo($valor)
    {
        if ($valor >= 0 && $valor <= 5) {
            return 10;
        } else {
            if ($valor >= 6 && $valor <= 30) {
                return 8;
            } else {
                if ($valor >= 31 && $valor <= 60) {
                    return 6;
                } else {
                    if ($valor >= 61 && $valor <= 90) {
                        return 8;
                    } else {
                        if ($valor >= 91) {
                            return 2;
                        } else {
                            if ($valor == -1) {
                                //sino tiene experiencia rediticia
                                return 2;
                            }
                        }
                    }
                }
            }
        }
    }
    public function experiencia_cre_ultimo($valor)
    {
        if ($valor >= 0 && $valor <= 5) {
            return 10;
        } else {
            if ($valor >= 6 && $valor <= 30) {
                return 8;
            } else {
                if ($valor >= 31 && $valor <= 60) {
                    return 6;
                } else {
                    if ($valor >= 61 && $valor <= 90) {
                        return 8;
                    } else {
                        if ($valor >= 91) {
                            return 2;
                        } else {
                            if ($valor == -1) {
                                //sino tiene experiencia rediticia
                                return 2;
                            }
                        }
                    }
                }
            }
        }
    }

    //CAPITAL
    public function f_endeudamiento_actual($valor)
    {
        if ($valor >= 0 && $valor <= 40) {
            return 10;
        } else {
            if ($valor > 40 && $valor <= 60) {
                return 5;
            } else {
                if ($valor > 60) {
                    return 1;
                }

            }
        }
    }

    public function f_endeudamiento_con_credito($valor)
    {
        if ($valor >= 0 && $valor <= 50) {
            return 10;
        } else {
            if ($valor > 50 && $valor <= 70) {
                return 5;
            } else {
                if ($valor > 70) {
                    return 1;
                }

            }
        }
    }
    //C3-------------------------------------------------------------------------------------------------------
    //CAPACIDAD DE PAGO
    public function cobertura_cuota($valor)
    {
        if ($valor >= 0 && $valor < 150) {
            return 1;
        } else {
            if ($valor >= 150 && $valor < 160) {
                return 5;
            } else {
                if ($valor >= 160 && $valor < 170) {
                    return 6;
                } else {
                    if ($valor >= 170 && $valor < 180) {
                        return 7;
                    } else {
                        if ($valor >= 180 && $valor < 190) {
                            return 8;
                        } else {
                            if ($valor >= 190 && $valor < 200) {
                                return 9;
                            } else {
                                if ($valor > 200) {
                                    return 10;
                                } else {
                                    return 0;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function gasto_anterior($valor)
    {
        if ($valor >= 0 && $valor < 50) {
            return 10;
        } else {
            if ($valor >= 50 && $valor < 55) {
                return 9;
            } else {
                if ($valor >= 55 && $valor < 59) {
                    return 8;
                } else {
                    if ($valor >= 59 && $valor < 63) {
                        return 7;
                    } else {
                        if ($valor >= 63 && $valor < 67) {
                            return 6;
                        } else {
                            if ($valor >= 67 && $valor < 70) {
                                return 5;
                            } else {
                                if ($valor > 70) {
                                    return 1;
                                } else {
                                    return 0;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function gasto_actual($valor)
    {
        if ($valor >= 0 && $valor < 60) {
            return 10;
        } else {
            if ($valor >= 60 && $valor < 65) {
                return 9;
            } else {
                if ($valor >= 65 && $valor < 69) {
                    return 8;
                } else {
                    if ($valor >= 69 && $valor < 73) {
                        return 7;
                    } else {
                        if ($valor >= 73 && $valor < 77) {
                            return 6;
                        } else {
                            if ($valor >= 77 && $valor < 80) {
                                return 5;
                            } else {
                                if ($valor > 80) {
                                    return 1;
                                } else {
                                    return 0;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
//C3 fin----------------------------------------------------

//C4 BEGIN

    public function ingresos_condiciones($valor)
    {
        if ($valor >= 0 && $valor <= 1000) {
            return 3;
        } else {
            if ($valor >= 1001 && $valor <= 1500) {
                return 4;
            } else {
                if ($valor >= 1501 && $valor <= 2000) {
                    return 6;
                } else {
                    if ($valor >= 2001 && $valor <= 2500) {
                        return 8;
                    } else {
                        if ($valor >= 2501 && $valor <= 3000) {
                            return 9;
                        } else {
                            if ($valor >= 3001) {
                                return 10;
                            }
                        }
                    }
                }
            }
        }
    }
//c4 end

//c5 functions begin
    public function garantias($valor)
    {
        if ($valor == 1) {
            return 5;
        } else {
            if ($valor == 2) {
                return 9;
            } else {
                if ($valor == 3) {
                    return 8;
                } else {
                    if ($valor == 4) {
                        return 10;
                    } else {
                        if ($valor == 5) {
                            return 6;
                        } else {
                            if ($valor == 6) {
                                return 4;
                            }
                        }
                    }
                }
            }
        }
    }
//c5 funtions end

//-------------------Funtions recomendacion
    public function recomendacion($valor)
    {
        if ($valor < 75) {
            return 'NEGADO';
        } else {
            if ($valor >= 75 && $valor < 90) {
                return 'APROBADO';
            } else {
                if ($valor >= 90 && $valor <= 100) {
                    return 'APROBADO';
                }
            }
        }
    }

    public function tipoRiesgo($valor)
    {
        if ($valor < 75) {
            return 'Riesgo no Aceptable';
        } else {
            if ($valor >= 75 && $valor < 90) {
                return 'Riesgo Moderado';
            } else {
                if ($valor >= 90 && $valor <= 100) {
                    return 'Riesgo Normal';
                }
            }
        }
    }
}
