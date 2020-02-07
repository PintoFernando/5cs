<?php
namespace sis5cs\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use sis5cs\ActividadEconomica;
use sis5cs\Area;
use sis5cs\BienesHogar;
use sis5cs\CapacidadPago;
use sis5cs\Codeudor;
use sis5cs\Conyugue;
use sis5cs\Credito;
use sis5cs\CuentasDocumentosCobrar;
use sis5cs\CuentasPorPagar;
use sis5cs\DatosEmpresa;
use sis5cs\DepositoBancario;
use sis5cs\Direccion;
use sis5cs\EfectivoCaja;
use sis5cs\Garante;
use sis5cs\Garantia;
use sis5cs\GastosFamiliares;
use sis5cs\GastosOperativosComercializacion;
use sis5cs\IngresoMensual;
use sis5cs\Inmueble;
use sis5cs\InventarioMercaderia;
use sis5cs\InversionesFinancieras;
use sis5cs\ManoObraMensual;
use sis5cs\MaquinariaEquipo;
use sis5cs\OtroActivo;
use sis5cs\Persona;
use sis5cs\PrestamoBancario;
use sis5cs\ReporteBuro;
use sis5cs\Seguimiento;
use sis5cs\User;
use sis5cs\Vehiculo;
use sis5cs\VentaComercializacionProducto;
use sis5cs\Croquis;
use sis5cs\ReferenciaSolicitante;

class SeguimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $creditos = DB::table('credito')
            ->join('persona', 'credito.id_persona', '=', 'persona.id_persona')
            ->select('credito.id_credito', 'credito.monto_solicitado', 'credito.id_tcredito', 'credito.desembolsado', 'persona.*')
            ->where('desembolsado', '=', null)
            ->get();
        // $d=(Carbon::parse($creditos[0]->created_at))->diffInDays(Carbon::parse(Carbon::now())); diferencia de fechas obtencion de dias
        return view('seguimiento.index')->with(compact('creditos'));
    }
    protected function documentos($id, $id_cre)
    {
        $d_persona=Persona::where('id_persona',$id)->firstOrFail();
        return view('seguimiento.documentos')->with(compact('d_persona'))
        ->with('socio_datos_personales', $this->persona($id))
        ->with('socio_credito', $this->credito($id))
        ->with('socio_garantia', $this->garantia($id))
        ->with('socio_croquis', $this->croquis($id))
        ->with('socio_datos_empresa', $this->datosEmpresa($id))
        ->with('socio_actividad_economica', $this->actividadEconomica($id))
        ->with('socio_conyugue', $this->conyugue($id))
        ->with('socio_referencia_solicitante', $this->referenciasSolicitante($id))
        ->with('socio_deposito_bancario', $this->depositoBancario($id))
        ->with('socio_inversiones_financieras', $this->inversionesFinancieras($id))
        ->with('socio_cuentas_documentos_cobrar', $this->cuentasDocumentosCobrar($id))
        ->with('socio_inventario_mercaderia', $this->inventarioMercaderia($id))
        ->with('socio_maquinaria_equipo', $this->maquinariaEquipo($id))
        ->with('socio_bienes_hogar', $this->bienesHogar($id))
        ->with('socio_inmuebles', $this->inmueble($id))
        ->with('socio_vehiculos', $this->vehiculo($id))
        ->with('socio_efectivos_caja', $this->efectivosCaja($id))
        ->with('socio_otros_activos', $this->otrosActivos($id))
        ->with('socio_prestamos_bancarios', $this->prestamoBancario($id))
        ->with('socio_cuentas_pagar', $this->prestamoBancario($id))
        ->with('socio_gastos_familiares', $this->gastosFamiliares($id))
        ->with('socio_gastos_operativos', $this->gastosOperativosComercializacion($id))
        ->with('socio_mano_obra', $this->manoObraMensual($id))
        ->with('socio_ingreso_mensual', $this->ingresoMensual($id))
        ->with('socio_venta_comercializacion', $this->ventaComercializacionProducto($id))
        ->with('socio_garante1', $this->garante1($id))
        ->with('socio_garante2', $this->garante2($id))
        ->with('socio_garante3', $this->garante3($id))
        ->with('socio_codeudor1', $this->codeudor1($id))
        ->with('socio_codeudor2', $this->codeudor2($id))
        ->with('socio_codeudor3', $this->codeudor3($id))
       
        ;
        /*
    $solicitud=$this->d_solicitud($id);
    $conyugue=$this->d_conyugue($id);
    $garante1=$this->d_garante1($id);
    $garante2=$this->d_garante2($id);
    $garante3=$this->d_garante3($id);
    $codeudor1=$this->d_codeudor1($id);
    $codeudor2=$this->d_codeudor2($id);
    $scor=$this->d_scor_socio($id);
    $persona=$this->d_caratulas($id);
    $informe_credito=$this->d_informe_credito($id);
    return view('seguimiento.documentos')
    ->with('solicitud',$solicitud)
    ->with('conyugue',$conyugue)
    ->with('garante1',$garante1)
    ->with('garante2',$garante2)
    ->with('garante3',$garante3)
    ->with('codeudor1',$codeudor1)
    ->with('codeudor2',$codeudor2)
    ->with('scor',$scor)
    ->with('persona',$persona)
    ->with('informe_credito',$informe_credito)
    ;*/
    }
    protected function seguimiento($id, $id_cre)
    {
        $persona = Persona::find($id);
        //Grafica de porcentaje
        $pllenadotb = $this->actividadEconomica($id) +
        $this->bienesHogar($id) +
        $this->capacidadPago($id) +
        $this->credito($id) +
        $this->cuentasPorPagar($id) +
        $this->datosEmpresa($id) +
        $this->depositoBancario($id) +
        $this->direccion($id) +
        $this->efectivosCaja($id) +
        $this->garantia($id) +
        $this->gastosFamiliares($id) +
        $this->gastosOperativosComercializacion($id) +
        $this->ingresoMensual($id) +
        $this->inmueble($id) +
        $this->inventarioMercaderia($id) +
        $this->inversionesFinancieras($id) +
        $this->manoObraMensual($id) +
        $this->maquinariaEquipo($id) +
        $this->otrosActivos($id) +
        $this->persona($id) +
        $this->prestamoBancario($id) +
        $this->reporteBuro($id) +
        $this->vehiculo($id) +
        $this->ventaComercializacionProducto($id); //25 tablas
        $porcentaje = round((100 * $pllenadotb) / 24);
        //-------------------Tiempo de seguimiento
        $tiempo_seguimiento = DB::table('seguimiento')
            ->select(DB::raw('sum(fecha_fin-fecha_inicio)'))
            ->where('id_credito', $id_cre)
            ->get();
        //-----------------End tiempo de seguimiento--------------------------
        $usuarios = User::All();
        $areas = Area::All();
        $seguimiento = DB::table('seguimiento')
            ->join('area', 'seguimiento.id_area', '=', 'area.id_area')
            ->join('users', 'seguimiento.id_users', '=', 'users.id_users')
            ->join('credito', 'seguimiento.id_credito', '=', 'credito.id_credito')
            ->select('area.*', 'users.*', 'credito.*', 'seguimiento.*')
            ->where('seguimiento.id_credito', $id_cre)
            ->get();
        return view('seguimiento.seguimiento')->with(compact('persona', 'seguimiento', 'usuarios', 'areas'))
            ->with('porcentaje', $porcentaje)
            ->with('tiempo_seguimiento', $tiempo_seguimiento);

    }
    //-------------------------------------funciones de consulta tabla llena
    protected function referenciasSolicitante($id)
    {
        $referencia = ReferenciaSolicitante::where('id_persona', $id)->exists();
        if ($referencia) {
            return 1;
        } else {
            return 0;
        }
    }
    protected function actividadEconomica($id)
    {
        $actividad_economica = ActividadEconomica::where('id_persona', $id)->exists();
        if ($actividad_economica) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function bienesHogar($id)
    {
        $bienes_hogar = BienesHogar::where('id_persona', $id)->exists();
        if ($bienes_hogar) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function capacidadPago($id)
    {
        $capacidad_pago = CapacidadPago::where('id_persona', $id)->exists();
        if ($capacidad_pago) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function credito($id)
    {
        $credito = Credito::where('id_persona', $id)->exists();
        if ($credito) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function cuentasDocumentosCobrar($id)
    {
        $cuentas = CuentasDocumentosCobrar::where('id_persona', $id)->exists();
        if ($cuentas) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function cuentasPorPagar($id)
    {
        $cuentas_pagar = CuentasPorPagar::where('id_persona', $id)->exists();
        if ($cuentas_pagar) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function datosEmpresa($id)
    {
        $datos_empresa = DatosEmpresa::where('id_persona', $id)->exists();
        if ($datos_empresa) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function depositoBancario($id)
    {
        $deposito_bancario = DepositoBancario::where('id_persona', $id)->exists();
        if ($deposito_bancario) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function direccion($id)
    {
        $direccion = Direccion::where('id_persona', $id)->exists();
        if ($direccion) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function efectivosCaja($id)
    {
        $efectivo_caja = EfectivoCaja::where('id_persona', $id)->exists();
        if ($efectivo_caja) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function garantia($id)
    {
        $id_credito = Credito::where('id_persona', $id)->exists();
        if ($id_credito) {
            $credito = Credito::where('id_persona', $id)->firstOrFail()->id_credito;
            $garantia = Garantia::where('id_credito', $credito)->exists();
            if ($garantia) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }

    }

    protected function gastosFamiliares($id)
    {
        $gastos_familiares = GastosFamiliares::where('id_persona', $id)->exists();
        if ($gastos_familiares) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function gastosOperativosComercializacion($id)
    {
        $gastos_operativos = GastosOperativosComercializacion::where('id_persona', $id)->exists();
        if ($gastos_operativos) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function ingresoMensual($id)
    {
        $ingreso_mensual = IngresoMensual::where('id_persona', $id)->exists();
        if ($ingreso_mensual) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function inmueble($id)
    {
        $inmueble = Inmueble::where('id_persona', $id)->exists();
        if ($inmueble) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function inventarioMercaderia($id)
    {
        $inventario_mercaderia = InventarioMercaderia::where('id_persona', $id)->exists();
        if ($inventario_mercaderia) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function inversionesFinancieras($id)
    {
        $inversiones_financieras = InversionesFinancieras::where('id_persona', $id)->exists();
        if ($inversiones_financieras) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function manoObraMensual($id)
    {
        $mano_obra = ManoObraMensual::where('id_persona', $id)->exists();
        if ($mano_obra) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function maquinariaEquipo($id)
    {
        $maquinaria_equipo = MaquinariaEquipo::where('id_persona', $id)->exists();
        if ($maquinaria_equipo) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function otrosActivos($id)
    {
        $otros_activos = OtroActivo::where('id_persona', $id)->exists();
        if ($otros_activos) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function persona($id)
    {
        $persona = Persona::where('id_persona', $id)->exists();
        if ($persona) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function prestamoBancario($id)
    {
        $prestamo = PrestamoBancario::where('id_persona', $id)->exists();
        if ($prestamo) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function reporteBuro($id)
    {
        $reporte_buro = ReporteBuro::where('id_persona', $id)->exists();
        if ($reporte_buro) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function vehiculo($id)
    {
        $vehiculo = Vehiculo::where('id_persona', $id)->exists();
        if ($vehiculo) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function croquis($id)
    {
        $croquis = Croquis::where('id_persona', $id)->exists();
        if ($croquis) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function ventaComercializacionProducto($id)
    {
        $venta = VentaComercializacionProducto::where('id_persona', $id)->exists();
        if ($venta) {
            return 1;
        } else {
            return 0;
        }
    }
    protected function conyugue($id)
    {
        $venta = Conyugue::where('id_persona', $id)->exists();
        if ($venta) {
            return 1;
        } else {
            return 0;
        }
    }
    protected function garante1($id)
    {
        $var = Garante::where('id_persona', $id)->where('ordinal_garante', 1)->exists();
        if ($var) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function garante2($id)
    {
        $var = Garante::where('id_persona', $id)->where('ordinal_garante', 2)->exists();
        if ($var) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function garante3($id)
    {
        $var = Garante::where('id_persona', $id)->where('ordinal_garante', 3)->exists();
        if ($var) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function codeudor1($id)
    {
        $var = Codeudor::where('id_persona', $id)->where('ordinal_codeudor', 1)->exists();
        if ($var) {
            return 1;
        } else {
            return 0;
        }
    }
    protected function codeudor2($id)
    {
        $var = Codeudor::where('id_persona', $id)->where('ordinal_codeudor', 2)->exists();
        if ($var) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function codeudor3($id)
    {
        $var = Codeudor::where('id_persona', $id)->where('ordinal_codeudor', 3)->exists();
        if ($var) {
            return 1;
        } else {
            return 0;
        }
    }

/*
//PARA DOCUMENTOS-------------------------------------
protected function d_solicitud($id)
{
$suma = $this->persona($id) + $this->credito($id) + $this->direccion($id);
if ($suma == 3) {
return 1;
} else {
return 0;
}

}
protected function d_conyugue($id)
{
if ($this->conyugue($id)) {
return 1;
} else {
return 0;
}
}

protected function d_garante1($id)
{
if ($this->garante1($id)) {
return 1;
} else {
return 0;
}
}
protected function d_garante2($id)
{
if ($this->garante2($id)) {
return 1;
} else {
return 0;
}
}
protected function d_garante3($id)
{
if ($this->garante3($id)) {
return 1;
} else {
return 0;
}
}
protected function d_codeudor1($id)
{
if ($this->codeudor1($id)) {
return 1;
} else {
return 0;
}
}
protected function d_codeudor2($id)
{
if ($this->codeudor2($id)) {
return 1;
} else {
return 0;
}
}
protected function d_scor_socio($id)
{
$suma = $this->persona($id)
+ $this->credito($id)
+ $this->direccion($id)
+ $this->actividadEconomica($id)
+ $this->bienesHogar($id)
+ $this->capacidadPago($id)
+ $this->cuentasDocumentosCobrar($id)
+ $this->cuentasPorPagar($id)
+ $this->datosEmpresa($id)
+ $this->depositoBancario($id)
+ $this->efectivosCaja($id)
+ $this->garantia($id)
+ $this->gastosFamiliares($id)
+ $this->gastosOperativosComercializacion($id)
+ $this->ingresoMensual($id)
+ $this->inmueble($id)
+ $this->inventarioMercaderia($id)
+ $this->inversionesFinancieras($id)
+ $this->manoObraMensual($id)
+ $this->maquinariaEquipo($id)
+ $this->otrosActivos($id)
+ $this->prestamoBancario($id)
+ $this->reporteBuro($id)
+ $this->vehiculo($id)
+ $this->ventaComercializacionProducto($id)
;
if ($suma >=15) {
return 1;
} else {
return 0;
}
}
protected function d_caratulas($id)
{
if ($this->persona($id)) {
return 1;
} else {
return 0;
}
}
protected function d_informe_credito($id)
{
$suma = $this->persona($id)
+ $this->credito($id)
+ $this->direccion($id)
+ $this->actividadEconomica($id)
+ $this->bienesHogar($id)
+ $this->capacidadPago($id)
+ $this->cuentasDocumentosCobrar($id)
+ $this->cuentasPorPagar($id)
+ $this->datosEmpresa($id)
+ $this->depositoBancario($id)
+ $this->efectivosCaja($id)
+ $this->garantia($id)
+ $this->gastosFamiliares($id)
+ $this->gastosOperativosComercializacion($id)
+ $this->ingresoMensual($id)
+ $this->inmueble($id)
+ $this->inventarioMercaderia($id)
+ $this->inversionesFinancieras($id)
+ $this->manoObraMensual($id)
+ $this->maquinariaEquipo($id)
+ $this->otrosActivos($id)
+ $this->prestamoBancario($id)
+ $this->reporteBuro($id)
+ $this->vehiculo($id)
+ $this->ventaComercializacionProducto($id)
;
if ($suma>=15) {
return 1;
} else {
return 0;
}
}

//FIN PARA DOCUMENTOS---------------------------------
 */

}
