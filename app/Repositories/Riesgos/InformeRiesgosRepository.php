<?php

namespace sis5cs\Repositories\Riesgos;

use DB;
use sis5cs\CapacidadPago;
use sis5cs\Seguimiento;
use Carbon\Carbon;
use sis5cs\Credito;

class InformeRiesgosRepository
{
    public static function credito($id_credito)
    {
        $credito = DB::table('credito')
            ->join('tipo_moneda', 'credito.id_tipo_moneda', '=', 'tipo_moneda.id_tipo_moneda')
            ->join('forma_pago', 'credito.id_forma_pago', '=', 'forma_pago.id_forma_pago')
            ->join('tipo_periodo_pago', 'credito.id_periodo_pago', '=', 'tipo_periodo_pago.id_periodo_pago')
            ->join('tipo_amortizacion', 'credito.id_tamortizacion', '=', 'tipo_amortizacion.id_tamortizacion')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito')
            ->select('credito.*', 'tipo_moneda.tipo_moneda', 'forma_pago.forma_pago', 'tipo_periodo_pago.periodo_pago', 'tipo_amortizacion.amortizacion', 'tipo_credito.tipo_credito', 'destino_credito.destino_credito')
            ->where('credito.id_credito', $id_credito)
            ->get();
        return $credito;
    }
    public static function persona($id_persona)
    {
        $persona = DB::table('persona')
            ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
            ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
            ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
            ->join('actividad_economica', 'persona.id_persona', '=', 'actividad_economica.id_persona', 'left outer')
            ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
            ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'actividad_economica.*', 'extension_ci.extension')
            ->where('persona.id_persona', $id_persona)
            ->get();
        return $persona;
    }

    /* Funcion par encontrar la fecha inicio y fin del tramite del crédito */
    public static function seguimientoGetFecha($option,$id_credito)
    {
       /*  Es 1 fecha inicio
        Es 2 fin */
        switch($option)
        {
            case 1:
                if (Seguimiento::where('id_credito', $id_credito)->exists()) {
                    return Carbon::parse(Seguimiento::where('id_credito', $id_credito)->orderBy('id_seguimiento', 'ASC')->get()->first()->created_at);
                } else {
                    return " ";
                }
                break;
            case 2:
                if (Seguimiento::where('id_credito', $id_credito)->exists()) {
                    return Carbon::parse(Seguimiento::where('id_credito', $id_credito)->orderBy('id_seguimiento', 'ASC')->get()->last()->created_at);
                } else {
                    return " ";
                }
                break;
        }
        
    }

    public function capacidadPago($id)
    {
        $capacidad = CapacidadPago::where('id_persona', $id)->exists();
        if ($capacidad) {
            $porcentaje = CapacidadPago::where('id_persona', $id)->firstOrFail()->porcentaje;
            return $porcentaje * 100;
        } else {
            return null;
        }
    }

    public static function cuota_mensual($id_persona)
    {
        $a = CapacidadPago::where('id_persona', $id_persona)->FirstOrFail()->amortizacion_coop_san_martin;
        return $a;
    }

    public static function ingreso_total($id_persona)
    {
        $ingreso_promedio_prestatario = DB::table('ingreso_mensual')->where('id_persona', $id_persona)->avg('prestatario');
        $ingreso_promedio_conyugue = DB::table('ingreso_mensual')->where('id_persona', $id_persona)->avg('conyugue');
        $ingreso_promedio_otros = DB::table('ingreso_mensual')->where('id_persona', $id_persona)->avg('otros');
        $ingreso_promedio_codeudores = DB::table('ingreso_mensual')->where('id_persona', $id_persona)->avg('codeudores');

        $total_mano_obra = DB::table('mano_obra_mensual')->where('id_persona', $id_persona)->sum('total_mano_obra');

        $total_gastos_operativos = DB::table('gastos_operativos_comercializacion')
            ->select(DB::raw('sum(COALESCE(combustible,0)+COALESCE(deposito_almacen,0)+COALESCE(energia_electrica,0)+COALESCE(agua,0)+COALESCE(gas,0)+COALESCE(telefono,0)+COALESCE(impuestos,0)+COALESCE(alquiler,0)+COALESCE(cuidado_sereno,0)+COALESCE(transporte,0)+COALESCE(mantenimiento,0)+COALESCE(publicidad,0)+COALESCE(otros,0))'))
            ->where('id_persona', $id_persona)
            ->get();

        $v_precio_total = DB::table('venta_comercializacion_productos')->where('id_persona', $id_persona)->sum('v_precio_total');
        $c_costo_total = DB::table('venta_comercializacion_productos')->where('id_persona', $id_persona)->sum('c_costo_total');

        $utilidad_operativa = ($ingreso_promedio_prestatario + $ingreso_promedio_conyugue + $ingreso_promedio_otros + $ingreso_promedio_codeudores + $v_precio_total) - ($c_costo_total + $total_mano_obra + $total_gastos_operativos[0]->sum);
        return $utilidad_operativa;
    }

    public static function patrimonio($id_persona)
    {
        $total_efectivos_caja = DB::table('efectivos_caja')->where('id_persona', $id_persona)->sum('caja');
        $total_depositos_bancarios = DB::table('deposito_bancario')->where('id_persona', $id_persona)->sum('saldo');
        $total_cuentas_cobrar = DB::table('cuentas_documentos_cobrar')->where('id_persona', $id_persona)->sum('saldo');
        $total_inversiones = DB::table('inversiones_financieras')->where('id_persona', $id_persona)->sum('valor_mercado');
        $total_maquinaria = DB::table('maquinaria_equipo')->where('id_persona', $id_persona)->sum('total');
        $total_mercaderia_inventarios = DB::table('inventario_mercaderia')->where('id_persona', $id_persona)->sum('total');
        $total_propiedades = DB::table('inmueble')->where('id_persona', $id_persona)->sum('valor');
        $total_vehiculos = DB::table('vehiculo')->where('id_persona', $id_persona)->sum('valor'); //sumatoria del total de pasivos
        $total_bienes_hogar = DB::table('bienes_hogar')->where('id_persona', $id_persona)->sum('valor'); //sumatoria del total de pasivos
        $total_otros_activos = DB::table('otros_activos')->where('id_persona', $id_persona)->sum('total') + $total_bienes_hogar; //sumatoria del total de pasivos
        $total_activos = $total_efectivos_caja + $total_depositos_bancarios + $total_cuentas_cobrar + $total_inversiones + $total_maquinaria + $total_mercaderia_inventarios + $total_propiedades + $total_vehiculos + $total_otros_activos; // II CALCULO DE ACTIVOS

        //CALCULO DE PASIVOS
        $total_prestamos_bancarios = DB::table('prestamo_bancario')->where('id_persona', $id_persona)->sum('saldo');
        $total_cuentas_por_pagar_saldo = DB::table('cuentas_por_pagar')->where('id_persona', $id_persona)->sum('saldo');
        $total_pasivos = $total_prestamos_bancarios + $total_cuentas_por_pagar_saldo;
        $patrimonio = $total_activos - $total_pasivos;
        return $patrimonio;
    }

    /*-----------------------------------------Total prestamos-----------------------------------------------*/
    public  function obligaciones_mensuales($id)
    {
        $total_prestamos = DB::table('prestamo_bancario')->where('id_persona', $id)->sum('importe_ultimo_pago');
        $tiene_capacidad = $this->amortizacionSanMartin($id) + $total_prestamos;
        return  $tiene_capacidad;
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


    /*--------get id_tcredito------*/
    public static function getidtipocredito($id)
    {
        $idtcredito = Credito::where('id_credito', $id)->get()->dia_pago;
        return  $idtcredito;
    }
}
