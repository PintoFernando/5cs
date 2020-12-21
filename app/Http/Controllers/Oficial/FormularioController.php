<?php
namespace sis5cs\Http\Controllers\Oficial;

use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\ActividadEconomica;
use sis5cs\BienesHogar;
use sis5cs\CapacidadPago;
use sis5cs\Conyugue;
use sis5cs\Credito;
use sis5cs\Croquis;
use sis5cs\CuentasDocumentosCobrar;
use sis5cs\CuentasPorPagar;
use sis5cs\DatosEmpresa;
use sis5cs\DepositoBancario;
use sis5cs\DetallePersona;
use sis5cs\Direccion;
use sis5cs\Garantia;
use sis5cs\GastosFamiliares;
use sis5cs\GastosOperativosComercializacion;
use sis5cs\Http\Controllers\Controller;
use sis5cs\IngresoMensual;
use sis5cs\Inmueble;
use sis5cs\InventarioMercaderia;
use sis5cs\InversionesFinancieras;
use sis5cs\ManoObraMensual;
use sis5cs\MaquinariaEquipo;
use sis5cs\OtroActivo;
use sis5cs\Persona;
use sis5cs\PrestamoBancario;
use sis5cs\ReferenciaSolicitante;
use sis5cs\TipoCredito;
use sis5cs\Vehiculo;
use sis5cs\VentaComercializacionProducto;
use sis5cs\Ventas;
use sis5cs\OrigenFondo;

class FormularioController extends Controller
{
    public $id_persona;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $this->id_persona = Session::get('id_persona');
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione un Crédito')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        //$id_persona =Session::get('id_persona');
        $if_exist_credito = Credito::where('id_persona', Session::get('id_persona'))->count();
        $credito = DB::table('credito')
            ->join('tipo_moneda', 'credito.id_tipo_moneda', '=', 'tipo_moneda.id_tipo_moneda')
            ->join('tipo_periodo_pago', 'credito.id_periodo_pago', '=', 'tipo_periodo_pago.id_periodo_pago')
            ->join('tipo_amortizacion', 'credito.id_tamortizacion', '=', 'tipo_amortizacion.id_tamortizacion')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito')
            ->leftJoin('origen_fondo', 'credito.id_origen', '=', 'origen_fondo.id_origen')
            ->select('credito.*', 'tipo_moneda.tipo_moneda', 'tipo_periodo_pago.periodo_pago', 'tipo_amortizacion.amortizacion',
                'tipo_credito.tipo_credito', 'destino_credito.destino_credito','origen_fondo.nombre')
                ->where('id_credito', Session::get('id_credito'))
            ->get();
        $if_exist_persona = Persona::where('id_persona', Session::get('id_persona'))->count();
        $personas = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil', 'extension_ci.extension', 'profesion.profesion')
            ->where('id_persona', $this->id_persona)
            ->get();

        //dd($persona);
        //referencia solicitante
        $if_exist_referencia = ReferenciaSolicitante::where('id_persona', Session::get('id_persona'))->count();
        $referencias = DB::table('referencias_solicitante')
            ->where('id_persona', Session::get('id_persona'))
            ->get();

        //patch solution begin
        if (!$credito->isEmpty()) {
            $if_exist_garantias = Garantia::where('id_credito', $credito[0]->id_credito)->count();
            $garantias = DB::table('credito')
                ->join('garantia', 'credito.id_credito', '=', 'garantia.id_credito')
                ->join('tipo_garantia', 'garantia.id_tipo_garantia', '=', 'tipo_garantia.id_tipo_garantia')
                ->select('tipo_garantia.*')
                ->where('credito.id_credito', $credito[0]->id_credito)
                ->get();
        } else {
            $if_exist_garantias = 0;
        }
        //patch solution end
        $if_exist_direccion = Direccion::where('id_persona', Session::get('id_persona'))->count();
        $direccion = DB::table('direccion')
            ->join('tipo_vivienda', 'direccion.id_tipo_vivienda', '=', 'tipo_vivienda.id_tipo_vivienda')
            ->select('direccion.*', 'tipo_vivienda.tipo_vivienda')
            ->where('id_persona', $this->id_persona)
            ->get();

        $if_exist_datos_empresa = DatosEmpresa::where('id_persona', Session::get('id_persona'))->count();
        $datos_empresa = DB::table('datos_empresa')
            ->join('afp', 'datos_empresa.id_afp', '=', 'afp.id_afp')
            ->join('tipo_contrato', 'datos_empresa.id_tc', '=', 'tipo_contrato.id_tc')
            ->select('datos_empresa.*', 'afp.nombre_afp', 'tipo_contrato.nombre_tc')
            ->where('id_persona', $this->id_persona)
            ->get();

        $if_exist_actividad_eco = ActividadEconomica::where('id_persona', Session::get('id_persona'))->count();
        $actividad_eco = ActividadEconomica::where('id_persona', Session::get('id_persona'))->get();

        $if_exists_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->count();
       
        if ($if_exists_conyugue > 0) {
            $conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
            $persona = DB::table('persona')
                ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
                ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
                ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
                ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext','left outer')
                ->join('detalle_persona', 'persona.id_persona', '=', 'detalle_persona.id_persona', 'left outer')
                ->select('persona.*', 'extension_ci.extension', 'profesion.profesion', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil', 'detalle_persona.ocupacion', 'detalle_persona.cargo', 'detalle_persona.tiempo_trabajo', 'detalle_persona.nombre_institucion', 'detalle_persona.calle_principal', 'detalle_persona.calle_secundaria', 'detalle_persona.telefono')
                ->where('persona.id_persona', $conyugue)
                ->get();
            $if_exist_detalle = DetallePersona::where('id_persona', $conyugue)->count();
        } else {
            $if_exists_conyugue = -1;
            $if_exist_detalle = -1;
        }

        $if_exist_deposito = DepositoBancario::where('id_persona', Session::get('id_persona'))->count();
        $deposito = DB::table('deposito_bancario')
            ->join('entidad_bancaria', 'deposito_bancario.id_entidad_bancaria', '=', 'entidad_bancaria.id_entidad_bancaria')
            ->join('tipo_deposito', 'deposito_bancario.id_tipo_deposito', '=', 'tipo_deposito.id_tipo_deposito')
            ->select('deposito_bancario.*', 'entidad_bancaria.nombre_entidad', 'tipo_deposito.nombre_deposito')
            ->where('id_persona', $this->id_persona)
            ->get();

        $if_exist_inversiones = InversionesFinancieras::where('id_persona', Session::get('id_persona'))->count();
        $inversiones = InversionesFinancieras::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_cuentas_cobrar = CuentasDocumentosCobrar::where('id_persona', Session::get('id_persona'))->count();
        $cuentas_cobrar = CuentasDocumentosCobrar::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_mercaderia = InventarioMercaderia::where('id_persona', Session::get('id_persona'))->count();
        $mercaderia = InventarioMercaderia::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_maquinaria = MaquinariaEquipo::where('id_persona', Session::get('id_persona'))->count();
        $maquinaria = MaquinariaEquipo::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_bienes = BienesHogar::where('id_persona', Session::get('id_persona'))->count();
        $bienes = BienesHogar::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_inmuebles = Inmueble::where('id_persona', Session::get('id_persona'))->count();
        $inmuebles = Inmueble::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_vehiculo = Vehiculo::where('id_persona', Session::get('id_persona'))->count();
        $vehiculo = Vehiculo::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_otros = OtroActivo::where('id_persona', Session::get('id_persona'))->count();
        $otros = OtroActivo::where('id_persona', Session::get('id_persona'))->get();
        $if_exist_prestamo = PrestamoBancario::where('id_persona', Session::get('id_persona'))->count();
        $prestamo = DB::table('prestamo_bancario')
            ->join('entidad_bancaria', 'prestamo_bancario.id_entidad_bancaria', '=', 'entidad_bancaria.id_entidad_bancaria')
            ->join('tipo_credito', 'prestamo_bancario.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->select('prestamo_bancario.*', 'entidad_bancaria.nombre_entidad', 'tipo_credito.tipo_credito')
            ->where('id_persona', $this->id_persona)
            ->get();

        $if_exist_cuentas = CuentasPorPagar::where('id_persona', Session::get('id_persona'))->count();
        $cuentas = CuentasPorPagar::where('id_persona', Session::get('id_persona'))->get();
// I CALCULO DE PASIVOS
        $total_efectivos_caja = DB::table('efectivos_caja')->where('id_persona', Session::get('id_persona'))->sum('caja');
        $total_depositos_bancarios = DB::table('deposito_bancario')->where('id_persona', Session::get('id_persona'))->sum('saldo');
        $total_cuentas_cobrar = DB::table('cuentas_documentos_cobrar')->where('id_persona', Session::get('id_persona'))->sum('saldo');
        $total_inversiones = DB::table('inversiones_financieras')->where('id_persona', Session::get('id_persona'))->sum('valor_mercado');
        $total_maquinaria = DB::table('maquinaria_equipo')->where('id_persona', Session::get('id_persona'))->sum('total');
        $total_mercaderia_inventarios = DB::table('inventario_mercaderia')->where('id_persona', Session::get('id_persona'))->sum('total');
        $total_propiedades = DB::table('inmueble')->where('id_persona', Session::get('id_persona'))->sum('valor');
        $total_vehiculos = DB::table('vehiculo')->where('id_persona', Session::get('id_persona'))->sum('valor'); //sumatoria del total de pasivos
        $total_bienes_hogar = DB::table('bienes_hogar')->where('id_persona', Session::get('id_persona'))->sum('valor'); //sumatoria del total de pasivos
        $total_otros_activos = DB::table('otros_activos')->where('id_persona', Session::get('id_persona'))->sum('total') + $total_bienes_hogar; //sumatoria del total de pasivos
        $total_activos = $total_efectivos_caja + $total_depositos_bancarios + $total_cuentas_cobrar + $total_inversiones + $total_maquinaria + $total_mercaderia_inventarios + $total_propiedades + $total_vehiculos + $total_otros_activos; // II CALCULO DE ACTIVOS
        //CALCULO DE PASIVOS
        $total_prestamos_bancarios = DB::table('prestamo_bancario')->where('id_persona', Session::get('id_persona'))->sum('saldo');
        $total_cuentas_por_pagar_saldo = DB::table('cuentas_por_pagar')->where('id_persona', Session::get('id_persona'))->sum('saldo');
        $total_pasivos = $total_prestamos_bancarios + $total_cuentas_por_pagar_saldo;

        //CALCULO PATRIMONIO
        $patrimonio = $total_activos - $total_pasivos;
//total suma de pasivos y patrimonio
        $total_pasivo_patrimonio = $patrimonio + $total_pasivos;

        $if_exist_ingresos = IngresoMensual::where('id_persona', Session::get('id_persona'))->count();
        $ingresos = IngresoMensual::where('id_persona', Session::get('id_persona'))->get();

        $if_exist_croquis_direccion = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 1)->count();

        $croquis_direccion = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 1)->first();

        $if_exist_croquis_trabajo = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 3)->count();
        $croquis_trabajo = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 3)->first();

        $if_exist_croquis_empresa = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 2)->count();
        $croquis_empresa = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 2)->first();
        $if_exist_ventas = Ventas::where('id_persona', Session::get('id_persona'))->count();

        $ventas = Ventas::where('id_persona', Session::get('id_persona'))->get();

        $if_exist_comercializacion = VentaComercializacionProducto::where('id_persona', Session::get('id_persona'))->count();

        $comercializacion = VentaComercializacionProducto::where('id_persona', Session::get('id_persona'))->get();

        $if_exist_obra = ManoObraMensual::where('id_persona', Session::get('id_persona'))->count();
        $obra = ManoObraMensual::where('id_persona', Session::get('id_persona'))->get();

        $if_exist_familiares = GastosFamiliares::where('id_persona', Session::get('id_persona'))->count();
        $familiares = GastosFamiliares::where('id_persona', Session::get('id_persona'))->get();

        $if_exist_operativos = GastosOperativosComercializacion::where('id_persona', Session::get('id_persona'))->count();
        $operativos = GastosOperativosComercializacion::where('id_persona', Session::get('id_persona'))->get();

        $ingreso_promedio_prestatario = DB::table('ingreso_mensual')->where('id_persona', Session::get('id_persona'))->avg('prestatario');
        $ingreso_promedio_conyugue = DB::table('ingreso_mensual')->where('id_persona', Session::get('id_persona'))->avg('conyugue');
        $ingreso_promedio_otros = DB::table('ingreso_mensual')->where('id_persona', Session::get('id_persona'))->avg('otros');
        $ingreso_promedio_codeudores = DB::table('ingreso_mensual')->where('id_persona', Session::get('id_persona'))->avg('codeudores');
        $ingreso_promedio_total = DB::table('ingreso_mensual')->where('id_persona', Session::get('id_persona'))->avg('total_ingreso');

        $v_precio_total = DB::table('venta_comercializacion_productos')->where('id_persona', Session::get('id_persona'))->sum('v_precio_total');
        $c_costo_total = DB::table('venta_comercializacion_productos')->where('id_persona', Session::get('id_persona'))->sum('c_costo_total');

        $u_utilidad = DB::table('venta_comercializacion_productos')->where('id_persona', Session::get('id_persona'))->sum('utilidad');

        $total_mano_obra = DB::table('mano_obra_mensual')->where('id_persona', Session::get('id_persona'))->sum('total_mano_obra');

        $total_gastos_operativos = DB::table('gastos_operativos_comercializacion')
            ->select(DB::raw('sum(COALESCE(combustible,0)+COALESCE(deposito_almacen,0)+COALESCE(energia_electrica,0)+COALESCE(agua,0)+COALESCE(gas,0)+COALESCE(telefono,0)+COALESCE(impuestos,0)+COALESCE(alquiler,0)+COALESCE(cuidado_sereno,0)+COALESCE(transporte,0)+COALESCE(mantenimiento,0)+COALESCE(publicidad,0)+COALESCE(otros,0))'))
            ->where('id_persona', Session::get('id_persona'))
            ->get();

        //utilidad operativa
        $utilidad_operativa = ($ingreso_promedio_prestatario + $ingreso_promedio_conyugue + $ingreso_promedio_otros + $ingreso_promedio_codeudores + $v_precio_total) - ($c_costo_total + $total_mano_obra + $total_gastos_operativos[0]->sum);

        $calculo = $utilidad_operativa * $this->capacidadPago(Session::get('id_persona'));

        $total_cuentas_por_pagar = DB::table('cuentas_por_pagar')->where('id_persona', Session::get('id_persona'))->sum('cuota_mensual');

        $total_gastos_familiares = DB::table('gastos_familiares')
            ->select(DB::raw('sum(COALESCE(alimentacion,0)+COALESCE(energia_electrica,0)+COALESCE(agua,0)+COALESCE(telefono,0)+COALESCE(gas,0)+COALESCE(impuestos,0)+COALESCE(alquileres,0)+COALESCE(educacion,0)+COALESCE(transporte,0)+COALESCE(salud,0)+COALESCE(empleada,0)+COALESCE(diversion,0)+COALESCE(vestimenta,0)+COALESCE(otros,0))'))
            ->where('id_persona', Session::get('id_persona'))
            ->get();

        //margen de ahorro
        $total_prestamos = DB::table('prestamo_bancario')->where('id_persona', Session::get('id_persona'))->sum('importe_ultimo_pago');
        $margen_ahorro = $utilidad_operativa - ($this->amortizacionSanMartin(Session::get('id_persona')) + $total_prestamos + $total_cuentas_por_pagar + $total_gastos_familiares[0]->sum);
        //Total egresos
        $total_egresos = $this->amortizacionSanMartin(Session::get('id_persona')) + $total_prestamos + $total_cuentas_por_pagar + $total_gastos_familiares->first()->sum;

        //CALIFICACION DE SI TIENE CAPACIDAD DE PAGO
        $tiene_capacidad = $this->amortizacionSanMartin(Session::get('id_persona')) + $total_prestamos;
        $resultado_capacidad = $this->tieneCapacidadPago($tiene_capacidad, $calculo);
        $tiene = $calculo - $tiene_capacidad;
        $inf_prestamos = DB::table('prestamo_bancario')
            ->join('entidad_bancaria', 'prestamo_bancario.id_entidad_bancaria', '=', 'entidad_bancaria.id_entidad_bancaria')
            ->join('tipo_credito', 'prestamo_bancario.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->select('prestamo_bancario.*', 'entidad_bancaria.nombre_entidad', 'tipo_credito.tipo_credito')
            ->where('id_persona', Session::get('id_persona'))
            ->get();
        return view('oficial.formulario.index')
            ->with(compact('direccion'
                , 'persona'
                , 'personas'
                , 'datos_empresa'
                , 'actividad_eco'
                , 'conyugue'
                , 'deposito'
                , 'deposito_plazo'
                , 'inversiones'
                , 'cuentas_cobrar'
                , 'mercaderia'
                , 'maquinaria'
                , 'bienes'
                , 'inmuebles'
                , 'vehiculo'
                , 'otros'
                , 'prestamo'
                , 'cuentas'
                , 'total_efectivos_caja'
                , 'total_depositos_bancarios'
                , 'total_otros_activos'
                , 'total_prestamos_bancarios'
                , 'total_cuentas_cobrar'
                , 'total_cuentas_por_pagar'
                , 'total_cuentas_por_pagar_saldo'
                , 'total_inversiones'
                , 'total_bienes_hogar'
                , 'total_activos'
                , 'total_maquinaria'
                , 'patrimonio'
                , 'total_mercaderia_inventarios'
                , 'total_propiedades'
                , 'total_vehiculos'
                , 'total_pasivos'
                , 'total_pasivo_patrimonio'
                , 'ingresos'
                , 'ventas'
                , 'comercializacion'
                , 'obra'
                , 'familiares'
                , 'operativos'
                , 'credito'
                , 'ingreso_promedio_prestatario'
                , 'ingreso_promedio_conyugue'
                , 'ingreso_promedio_otros'
                , 'ingreso_promedio_codeudores'
                , 'referencias'
                , 'garantias'
                , 'croquis_direccion'
                , 'croquis_trabajo'
                , 'croquis_empresa'
            ))
            ->with('if_exist_credito', $if_exist_credito)
            ->with('if_exist_garantias', $if_exist_garantias)
            ->with('if_exists_conyugue', $if_exists_conyugue)
            ->with('if_exist_referencia', $if_exist_referencia)
            ->with('if_exist_croquis_direccion', $if_exist_croquis_direccion)
            ->with('if_exist_croquis_trabajo', $if_exist_croquis_trabajo)
            ->with('if_exist_croquis_empresa', $if_exist_croquis_empresa)
            ->with('if_exist_persona', $if_exist_persona)
            ->with('if_exist_direccion', $if_exist_direccion)
            ->with('if_exist_datos_empresa', $if_exist_datos_empresa)
            ->with('if_exist_actividad_eco', $if_exist_actividad_eco)
            ->with('if_exist_persona', $if_exist_persona)
            ->with('if_exist_deposito', $if_exist_deposito)
            ->with('if_exist_inversiones', $if_exist_inversiones)
            ->with('if_exist_cuentas_cobrar', $if_exist_cuentas_cobrar)
            ->with('if_exist_mercaderia', $if_exist_mercaderia)
            ->with('if_exist_maquinaria', $if_exist_maquinaria)
            ->with('if_exist_bienes', $if_exist_bienes)
            ->with('if_exist_inmuebles', $if_exist_inmuebles)
            ->with('if_exist_vehiculo', $if_exist_vehiculo)
            ->with('if_exist_otros', $if_exist_otros)
            ->with('if_exist_prestamo', $if_exist_prestamo)
            ->with('if_exist_cuentas', $if_exist_cuentas)
            ->with('if_exist_ingresos', $if_exist_ingresos)
            ->with('if_exist_ventas', $if_exist_ventas)
            ->with('if_exist_comercializacion', $if_exist_comercializacion)
            ->with('if_exist_obra', $if_exist_obra)
            ->with('if_exist_familiares', $if_exist_familiares)
            ->with('if_exist_operativos', $if_exist_operativos)
            ->with('if_exist_detalle', $if_exist_detalle)
            ->with('ingreso_promedio_prestatario', round($ingreso_promedio_prestatario * 100) / 100)
            ->with('ingreso_promedio_conyugue', round($ingreso_promedio_conyugue * 100) / 100)
            ->with('ingreso_promedio_otros', round($ingreso_promedio_otros * 100) / 100)
            ->with('ingreso_promedio_codeudores', round($ingreso_promedio_codeudores * 100) / 100)
            ->with('ingreso_promedio_total', round($ingreso_promedio_total * 100) / 100)
            ->with('v_precio_total', round($v_precio_total * 100) / 100)
            ->with('c_costo_total', round($c_costo_total * 100) / 100)
            ->with('u_utilidad', round($u_utilidad * 100) / 100)
            ->with('total_mano_obra', round($total_mano_obra * 100) / 100)
            ->with('total_gastos_operativos', round($total_gastos_operativos[0]->sum * 100) / 100)
            ->with('utilidad_operativa', round($utilidad_operativa * 100) / 100)
            ->with('tipo_credito', $this->tipoCredito(Session::get('id_credito')))
            ->with('porcentaje_capacidad_pago', $this->capacidadPago(Session::get('id_persona')))
            ->with('calculo', round($calculo * 100) / 100)
            ->with('amortizacion_san_martin', $this->amortizacionSanMartin(Session::get('id_persona')))
            ->with('total_cuentas_por_pagar', round($total_cuentas_por_pagar * 100) / 100)
            ->with('total_gastos_familiares', round($total_gastos_familiares[0]->sum * 100) / 100)
            ->with('total_egresos', round($total_egresos * 100) / 100)
            ->with('margen_ahorro', round($margen_ahorro * 100) / 100)
            ->with('resultado_capacidad', $resultado_capacidad)
            ->with('inf_prestamos', $inf_prestamos)
            ->with('tiene', $tiene)
        ;

    }
    public function tipoCredito($id)
    {
        $creditos = DB::table('credito')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->select('credito.*', 'tipo_credito.tipo_credito')
            ->where('id_credito', $id)
            ->get();

        if (!$creditos->isEmpty()) {
            return $creditos[0]->tipo_credito;
        } else {
            return " ";
        }
    }

    public function capacidadPago($id)
    {
        $capacidad = CapacidadPago::where('id_persona', $id)->exists();
        if ($capacidad) {
            $porcentaje = CapacidadPago::where('id_persona', $id)->firstOrFail()->porcentaje;
            return $porcentaje;
        } else {
            return null;
        }
    }

    public function amortizacionSanMartin($id)
    {
        $capacidad = CapacidadPago::where('id_persona', $id)->exists();
        if ($capacidad) {
            $amortizacion_coop_san_martin = CapacidadPago::where('id_persona', $id)->firstOrFail()->amortizacion_coop_san_martin;
            return $amortizacion_coop_san_martin;
        } else {
            return 0;
        }
    }

    public function tieneCapacidadPago($a, $b)
    {
        if ($a < $b) {
            return "TIENE CAPACIDAD DE PAGO";
        } else {
            return "NO TIENE CAPACIDAD DE PAGO";
        }
    }

}
