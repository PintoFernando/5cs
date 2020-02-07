<?php
namespace sis5cs\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use sis5cs\Credito;
use sis5cs\DatosActividadEconomica;
use sis5cs\DatosEmpresa;
use sis5cs\Direccion;
use sis5cs\Persona;
use sis5cs\ReporteBuro;
use sis5cs\TipoCredito;
use sis5cs\TipoVivienda;

class FormularioSocioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request) {
            $personas = Persona::All();
            return view('solicitud.ejemplo')->with(compact('personas'));
        } //busqueda por nombre y ci
        /*$clientes=Cliente::paginate(7);
    return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }

    public function solicitud($id)
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
        $actividad_economica = DatosActividadEconomica::where('id_persona', $id)->firstOrFail();
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
        $porcentaje_c1 = ($total_c1 * 100) / 50;

        //CÁLCULO DE C2

        //Calculo de endeudamiento actual
        $endeudamiento_actual = round(($this->total_pasivos($id) / $this->total_activos($id)) * 100);
        $monto_solicitado = Credito::where('id_persona', $id)->firstOrFail()->monto_solicitado;
        $endeudamiento_con_este_credito = round((($this->total_pasivos($id) + $monto_solicitado) / $this->total_activos($id)) * 100);

        $pendeudamiento_actual = $this->f_endeudamiento_actual($endeudamiento_actual);

        $pendeudamiento_con_este_credito = $this->f_endeudamiento_con_credito($endeudamiento_con_este_credito);

        //calculo total de c2
        $total_c2 = $pendeudamiento_actual + $pendeudamiento_con_este_credito;

        //CALCULO DE C3

        return view('solicitud.solicitud')
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

        ;

    }

    //CALCULO DE LAS 5CS
    //C1
    //CARACTER
    //Residencia
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

    //funciones de calculo de los parametros 5cs
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
    //C3
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
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}
