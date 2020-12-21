<?php
namespace sis5cs\Http\Controllers\Oficial;

use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

use sis5cs\Persona;
use sis5cs\Credito;
use sis5cs\DestinoCredito;
use sis5cs\EntidadBancaria;
use sis5cs\TipoCredito;
use sis5cs\TipoMoneda;
use sis5cs\TipoPeriodoPago;
use sis5cs\TipoAmortizacion;
use sis5cs\FormaPago;
use sis5cs\Requisitos;
use sis5cs\User;
use sis5cs\OrigenFondo;
use sis5cs\Http\Requests\CreditoFormRequest;
use DB;
use Fpdf;
use Auth;
use Alert;
use Session;

class CreditoController extends Controller
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
    } else {
      $creditos = DB::table('credito')
      ->join('tipo_moneda', 'credito.id_tipo_moneda', '=', 'tipo_moneda.id_tipo_moneda')
      ->join('tipo_periodo_pago', 'credito.id_periodo_pago', '=', 'tipo_periodo_pago.id_periodo_pago')
      ->join('tipo_amortizacion', 'credito.id_tamortizacion', '=', 'tipo_amortizacion.id_tamortizacion')
      ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
      ->join('destino_credito', 'credito.id_destino_credito', '=', 'destino_credito.id_destino_credito')
      ->leftJoin('origen_fondo', 'credito.id_origen', '=', 'origen_fondo.id_origen')
      ->select('credito.*', 'tipo_moneda.tipo_moneda', 'destino_credito.destino_credito', 'tipo_credito.tipo_credito', 'tipo_periodo_pago.periodo_pago', 'tipo_amortizacion.amortizacion','origen_fondo.nombre')
      ->where('id_persona', $this->id_persona)
      ->get();
      return view('oficial.credito.index')->with(compact('creditos'));
    }

  }
  public function create()
  {
    if (Session::get('id_persona') == null) {
      alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
      return redirect('oficial/dashboard/');
    } else {
      $if_exist = Credito::where('id_persona', Session::get('id_persona'))->count();
      if ($if_exist > 100) {
        alert()->info('Info', 'Ya registro la Solicitud de Credito.')->showConfirmButton();
        return redirect('oficial/credito/');
      } else {
        $entidad = EntidadBancaria::all();
        $tipo = TipoMoneda::all();
        $tipo_p = TipoPeriodoPago::all();
        $tipo_credito = TipoCredito::all();
        $tipo_a = TipoAmortizacion::all();
        $destino = DestinoCredito::all();
        $forma = FormaPago::all();
        $origen_fondo = OrigenFondo::all();
        return view('oficial.credito.create')
        ->with(compact('entidad', 'tipo', 'tipo_p', 'tipo_credito', 'tipo_a', 'destino','forma','origen_fondo'));
      }


    }

  }


  public function store(CreditoFormRequest $request)
  {
    $this->id_persona = Session::get('id_persona');
    $cre = new Credito();
    $cre->fecha_solicitud = $request->input('fecha_solicitud');
    $cre->monto_solicitado = $request->input('monto_solicitado');
    $cre->plazo_meses = $request->input('plazo_meses');
    $cre->dia_pago = $request->input('dia_pago');
    $cre->id_tipo_moneda = $request->input('id_tipo_moneda');
    $cre->id_origen = $request->input('id_origen');
    $cre->id_periodo_pago = $request->input('id_periodo_pago');
    $cre->id_tamortizacion = $request->input('id_tamortizacion');
    $cre->id_tcredito = $request->input('id_tcredito');
    $cre->id_destino_credito = $request->input('id_destino_credito');
    $cre->id_forma_pago = $request->input('id_forma_pago');
    $cre->interes_nominal =$this->interesNominal($request->input('id_tcredito'));
    $cre->id_persona = $this->id_persona;
    $cre->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification= 'Exelente los datos se han guardado correctamente'; 
    return redirect('oficial/credito')->with(compact('notification'));
  }

  public function edit($id)
  {
    $periodo_pago = TipoPeriodoPago::All();
    $moneda = TipoMoneda::All();
    $amortizacion = TipoAmortizacion::All();
    $tipo_credito = TipoCredito::All();
    $destino_credito = DestinoCredito::All();
    $forma = FormaPago::All();
    $origen_fondo = OrigenFondo::all();
    $cre = Credito::find($id);
 
    return view('oficial.credito.edit')->with(compact('cre', 'periodo_pago', 'moneda', 'amortizacion', 'tipo_credito', 'destino_credito','forma','origen_fondo')); //formulario de registro
  }
  public function update(CreditoFormRequest $request, $id)
  {
    $this->id_persona = Session::get('id_persona');
    $cre = Credito::find($id);
    $cre->fecha_solicitud = $request->input('fecha_solicitud');
    $cre->monto_solicitado = $request->input('monto_solicitado');
    $cre->interes_nominal =$request->input('interes_nominal');
    $cre->plazo_meses = $request->input('plazo_meses');
    $cre->dia_pago = $request->input('dia_pago');
    $cre->id_tipo_moneda = $request->input('id_tipo_moneda');
    $cre->id_periodo_pago = $request->input('id_periodo_pago');
    $cre->id_tamortizacion = $request->input('id_tamortizacion');
    $cre->id_tcredito = $request->input('id_tcredito');
    $cre->id_persona = $this->id_persona;
    $cre->id_destino_credito = $request->input('id_destino_credito');
    $cre->id_forma_pago = $request->input('id_forma_pago');
    $cre->id_origen = $request->input('id_origen');
    $cre->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification= 'Exelente los datos se han modificado correctamente'; 
    return redirect('oficial/credito')->with(compact('notification'));
  }


  public function interesNominal($valor)
  {
    if ($valor == 1) {
      return 0.16;
    } else {
      if ($valor == 2) {
        return 0.24;
      } else {
        if ($valor == 3) {
          return 0.16;
        } else {
          if ($valor == 4) {
            return 0.18;
          } else {
            if ($valor == 5) {
              return 0.15;
            } else {
              if ($valor == 6) {
                return 0.15;
              } else {
                if ($valor == 7) {
                  return 0.17;
                }
                else
                {
                  if($valor==8)
                  {
                    return 0.24;
                  }
                  else
                  {
                    if($valor==9)
                    {
                      return 0.19;
                    }
                    else
                    {
                      if($valor==10)
                      {
                        return 0.17;
                      }
                      else
                      {
                        if($valor==11)
                        {
                          return 0.10;
                        }
                        else
                        {
                          if($valor==12)
                          {
                            return 0.17;
                          }
                          else
                          {
                            if($valor==13)
                            {
                              return 0.15;
                            }
                            else
                            {
                              if($valor==14)
                              {
                                return 0.13;
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }

}
