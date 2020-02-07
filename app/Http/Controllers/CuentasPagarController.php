<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use sis5cs\CuentasPorPagar;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\CuentasPagarFormRequest;

class CuentasPagarController extends Controller
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
            return redirect('/dashboard/');
        } else {

            $pagar = CuentasPorPagar::where('id_persona', Session::get('id_persona'))->get();
            return view('cuentas_por_pagar.index')->with(compact('pagar'));

        }

    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $if_exist = CuentasPorPagar::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist > 2) {
                alert()->info('Info', 'Ya registro las datos de cuentas por pagar')->showConfirmButton();
                return redirect('/cuentas_por_pagar/');
            } else {
                return view('cuentas_por_pagar.create');
            }
        }}

    public function store(CuentasPagarFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $in = new CuentasPorPagar();
        $in->institucion = $request->input('institucion');
        $in->tiempo = $request->input('tiempo');
        $in->cuota_mensual = $request->input('cuota_mensual');
        $in->saldo = $request->input('saldo');
        $in->id_persona = $this->id_persona;
        //$in->id_persona=$request->input('id_persona');
        $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla return redirect('oficial/direccion');
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/cuentas_por_pagar')->with(compact('notification'));
    }

    public function edit($id)
    {
        $cuentas = CuentasPorPagar::find($id);
        return view('cuentas_por_pagar.edit')->with(compact('cuentas')); //formulario de registro
    }
    public function update(CuentasPagarFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $cuentas = CuentasPorPagar::find($id);
        $cuentas->institucion = $request->input('institucion');
        $cuentas->tiempo = $request->input('tiempo');
        $cuentas->cuota_mensual = $request->input('cuota_mensual');
        $cuentas->saldo = $request->input('saldo');
        $cuentas->id_persona = $this->id_persona;
        $cuentas->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos se han modificado correctamente';
        return redirect('/cuentas_por_pagar/')->with(compact('notification'));
    }
    public function destroy($id)
    {
        $cu = CuentasPorPagar::find($id);
        $cu->delete(); //delete
        return back();
    }
}
