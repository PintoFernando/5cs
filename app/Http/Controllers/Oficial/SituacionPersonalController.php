<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

use sis5cs\DepositoBancario;
use sis5cs\CuentasDocumentosCobrar;
use sis5cs\InversionesFinancieras;
use sis5cs\MaquinariaEquipo;
use sis5cs\InventarioMercaderia;
use sis5cs\Inmueble;
use sis5cs\Vehiculo;
use DB;
use Session;

class SituacionPersonalController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {


// I CALCULO DE ACTIVOS
    $total_efectivos_en_caja=DB::table('efectivos_caja')->where('id_persona', Session::get('id_persona'))->sum('caja');
    $total_depositos_bancarios=DB::table('deposito_bancario')->where('id_persona', Session::get('id_persona'))->sum('saldo');
    $total_cuentas_cobrar=DB::table('cuentas_documentos_cobrar')->where('id_persona', Session::get('id_persona'))->sum('saldo');
    $total_inversiones=DB::table('inversiones_financieras')->where('id_persona', Session::get('id_persona'))->sum('valor_mercado');
    $total_maquinaria=DB::table('maquinaria_equipo')->where('id_persona', Session::get('id_persona'))->sum('total');
     $total_mercaderias=DB::table('inventario_mercaderia')->where('id_persona', Session::get('id_persona'))->sum('total');     

    //$total_mercaderia_inventarios=DB::table('inventario_mercaderia')->where('id_persona', Session::get('id_persona'))->sum('precio_unitario*cantidad');
    $total_propiedades=DB::table('inmueble')->where('id_persona', Session::get('id_persona'))->sum('valor');
    $total_vehiculos=DB::table('vehiculo')->where('id_persona', Session::get('id_persona'))->sum('valor');    //sumatoria del total de pasivos
    $total_bienes_hogar=DB::table('bienes_hogar')->where('id_persona', Session::get('id_persona'))->sum('valor');    //sumatoria del total de pasivos
    $total_otros_activos=DB::table('otros_activos')->where('id_persona', Session::get('id_persona'))->sum('total')+$total_bienes_hogar;    //sumatoria del total de pasivos
    $total_activos=$total_efectivos_en_caja+$total_depositos_bancarios+$total_cuentas_cobrar+$total_inversiones+$total_maquinaria+$total_mercaderias+$total_propiedades+$total_vehiculos+$total_otros_activos;     // II CALCULO DE ACTIVOS
   //CALCULO DE PASIVOS
    $total_prestamos_bancarios=DB::table('prestamo_bancario')->where('id_persona', Session::get('id_persona'))->sum('saldo');
    $total_cuentas_por_pagar=DB::table('cuentas_por_pagar')->where('id_persona', Session::get('id_persona'))->sum('saldo');
    $total_pasivos=$total_prestamos_bancarios+$total_cuentas_por_pagar;

      //CALCULO PATRIMONIO
      $patrimonio=$total_activos-$total_pasivos;
//total suma de pasivos y patrimonio
      $total_pasivo_patrimonio=$patrimonio+$total_pasivos;
    return view('oficial.situacion_personal.index')
    ->with('total_efectivos_caja',$total_efectivos_en_caja)
    ->with('total_depositos_bancarios',$total_depositos_bancarios)
    ->with('total_cuentas_cobrar',$total_cuentas_cobrar)
    ->with('total_inversiones',$total_inversiones)
    ->with('total_maquinaria',$total_maquinaria)
    ->with('total_mercaderia_inventarios',$total_mercaderias)
    ->with('total_propiedades',$total_propiedades)
    ->with('total_vehiculos',$total_vehiculos)
    ->with('total_otros_activos',$total_otros_activos)
    ->with('total_activos',$total_activos)
    //pasivos
    ->with('total_prestamos_bancarios',$total_prestamos_bancarios)
    ->with('total_cuentas_por_pagar',$total_cuentas_por_pagar)
    ->with('total_pasivos',$total_pasivos)
    ->with('patrimonio',$patrimonio)
    ->with('total_pasivo_patrimonio',$total_pasivo_patrimonio)
    ;   


  }  
  
}
