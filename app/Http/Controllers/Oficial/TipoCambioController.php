<?php

namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use Session;
use sis5cs\Credito;
use sis5cs\Http\Controllers\Controller;
use sis5cs\TipoCambio;
use sis5cs\Http\Requests\TipoCambioFormRequest;
class TipoCambioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {       
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
            $e_tipo_cambio = TipoCambio::where('id_credito', $id_credito)->count();
            if ($e_tipo_cambio > 0) {
                $cambios = TipoCambio::where('id_credito', $id_credito)->get();
                return view('oficial.tipo_cambio.index')->with(compact('cambios'));
            } else {
                return view('oficial.tipo_cambio.create');
            }

        }

    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $ecredito = Credito::where('id_persona', Session::get('id_persona'))->count();
        if ($ecredito == 0) {
            alert()->info('Info', 'Llene datos de Crédito Primero')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
        $e_tipo_cambio = TipoCambio::where('id_credito', $id_credito)->count();
        if ($e_tipo_cambio > 0) {
            return redirect('oficial/tipo_cambio/');
        } else {
            return view('oficial.tipo_cambio.create');
        }

    }

    public function store(TipoCambioFormRequest $request)
    {

        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $ecredito = Credito::where('id_persona', Session::get('id_persona'))->count();
        if ($ecredito == 0) {
            alert()->info('Info', 'Llene datos de Crédito Primero')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
        $ca = new TipoCambio();
        $ca->cambio = $request->input('cambio');
        $ca->id_credito = $id_credito;
        $ca->save(); //metodo se encarga de ejecutar un insert sobre la tabla return redirect('oficial/direccion');
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/tipo_cambio')->with(compact('notification'));
    }

    public function edit($id)
    {
        $cambio= TipoCambio::find($id);
        return view('oficial.tipo_cambio.edit')->with(compact('cambio')); //formulario de registro
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cambio' => 'numeric'
        ]);
        $ca = TipoCambio::find($id);
        $ca->cambio = $request->input('cambio');       
        $ca->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('oficial/tipo_cambio')->with(compact('notification'));
    }
    /*-------------
public function destroy($id)
{

$cro=Croquis::find($id);
$cro->delete(); //delete
return back();
}--------------*/
}
