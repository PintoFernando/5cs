<?php
namespace sis5cs\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Requests\InversionesFinancierasFormRequest;
use sis5cs\InversionesFinancieras;

class InversionesFinancierasController extends Controller
{
    public $id_persona;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //$this->id_persona=Session::get('id_persona');
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $inversiones = InversionesFinancieras::where('id_persona', Session::get('id_persona'))->get();
            return view('inversiones_financieras.index')->with(compact('inversiones'));
        }

    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {

            $if_exist = InversionesFinancieras::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist > 5) {
                alert()->info('Info', 'Ya registro los datos de inversiones financieras')->showConfirmButton();
                return redirect('/inversiones_financieras/');
            } else {
                return view('inversiones_financieras.create');
            }
        }
    }

    public function store(InversionesFinancierasFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $inversiones = new InversionesFinancieras();
        $inversiones->cantidad = $request->input('cantidad');
        $inversiones->porcentaje_patrimonio_empre = $request->input('porcentaje_patrimonio_empre');
        $inversiones->nit = $request->input('nit');
        $inversiones->nombre_empresa = $request->input('nombre_empresa');
        $inversiones->valor_nominal = $request->input('valor_nominal');
        $inversiones->valor_mercado = $request->input('valor_mercado');
        $inversiones->detalle = $request->input('detalle');
        $inversiones->id_persona = $this->id_persona;
        $inversiones->save(); //metodo se encarga de ejecutar un insert sobre la tabla

        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/inversiones_financieras')->with(compact('notification'));
    }

    public function edit($id)
    {
        $inversiones = InversionesFinancieras::find($id);
        return view('inversiones_financieras.edit')->with(compact('inversiones')); //formulario de registro
    }
    public function update(InversionesFinancierasFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $inversiones = InversionesFinancieras::find($id);
        $inversiones->cantidad = $request->input('cantidad');
        $inversiones->porcentaje_patrimonio_empre = $request->input('porcentaje_patrimonio_empre');
        $inversiones->nit = $request->input('nit');
        $inversiones->nombre_empresa = $request->input('nombre_empresa');
        $inversiones->valor_nominal = $request->input('valor_nominal');
        $inversiones->valor_mercado = $request->input('valor_mercado');
        $inversiones->detalle = $request->input('detalle');
        $inversiones->id_persona = $this->id_persona;
        $inversiones->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('/inversiones_financieras')->with(compact('notification'));
    }
    public function destroy($id)
    {
        $me = InversionesFinancieras::find($id);
        $me->delete(); //delete
        return back();
    }
}
