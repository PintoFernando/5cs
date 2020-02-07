<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use sis5cs\Persona;
use sis5cs\Credito;
use sis5cs\DestinoCredito;
use sis5cs\TipoCredito;
use sis5cs\TipoMoneda;
use sis5cs\TipoPeriodoPago;
use sis5cs\TipoAmortizacion;
use sis5cs\Requisitos;
use sis5cs\User;
use sis5cs\Http\Requests\CreditoFormRequest;
use DB;
use Fpdf;
use Auth;
use Alert;

class CreditoController extends Controller
{
 public function __construct()
  {
    $this->middleware('auth');
  }
  public $id_tcredito;
  public function index(Request $request)
   {

     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $credito=Credito::where('id_persona',$id_persona)->first();
     //datos de relaciones
     $tipo_credito=TipoCredito::where('id_tcredito',$credito->id_tcredito)->firstOrFail()->tipo_credito;
     $tipo_moneda=TipoMoneda::where('id_tipo_moneda',$credito->id_tipo_moneda)->firstOrFail()->tipo_moneda;
     $destino=DestinoCredito::where('id_destino_credito',$credito->id_destino_credito)->firstOrFail()->destino_credito;
     return view('cliente.credito.index')->with(compact('credito'))->with('tipo_credito',$tipo_credito)->with('destino',$destino)->with('tipo_moneda',$tipo_moneda);   
   }

   public function create()
   {
     $id_user=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema
     $per=Credito::where('id_persona',$id_user)->count();
     if($per>0)
     {
      alert()->info('Info','Ya registro sus datos del crédito.')->showConfirmButton();
      return redirect('cliente/credito/');
     }
    else
    {
      $destino=DestinoCredito::all();   
      $tipo_credito=TipoCredito::all();   
      $tipo_amortizacion=TipoAmortizacion::all();   
      $tipo_moneda=TipoMoneda::all();  
      $tipo_periodo_pago=TipoPeriodoPago::all();  
      return view('cliente.credito.create')->with(compact('destino','tipo_credito','tipo_amortizacion','tipo_moneda','tipo_periodo_pago'));
    } 
  }

  public function store(CreditoFormRequest $request)
  {
       // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
    $id_persona=Auth::user()->id_persona;
    $credito= new Credito();      
    $credito->fecha_solicitud=$request->input('fecha_solicitud');
    $credito->monto_solicitado=$request->input('monto_solicitado');
    $credito->interes_nominal=$request->input('interes_nominal');
    $credito->plazo_meses=$request->input('plazo_meses');
    $credito->dia_pago=$request->input('dia_pago');
    $credito->id_tipo_moneda=$request->input('id_tipo_moneda');
    $credito->id_tipo_moneda=$request->input('id_tipo_moneda');
    $credito->id_periodo_pago=$request->input('id_periodo_pago');
    $credito->id_tamortizacion=$request->input('id_tamortizacion');
    $credito->id_tcredito=$request->input('id_tcredito');
    $credito->id_destino_credito=$request->input('id_destino_credito');
    $credito->id_persona=$id_persona;
    $credito->save(); //metodo se encarga de ejecutar un insert sobre la tabla  
    alert()->success('Exelente','Exelente sus datos  se han agregado correctamente')->showConfirmButton();
      $notification= 'Exelente sus datos se han agregado correctamente';     
      return redirect('cliente/credito/')->with(compact('notification'));
    }
    
}
