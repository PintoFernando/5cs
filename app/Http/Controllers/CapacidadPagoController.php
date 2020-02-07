<?php
namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use sis5cs\CapacidadPago;
use sis5cs\Http\Requests\CapacidadPagoFormRequest;
use sis5cs\TipoCredito;

class CapacidadPagoController extends Controller
{
    public $id_persona;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $capacidad = CapacidadPago::where('id_persona', Session::get('id_persona'))->get();
            return view('capacidad_pago.index')->with(compact('capacidad'));
        }

    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $if_exist = CapacidadPago::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist > 0) {
                alert()->info('Info', 'Ya registro los datos de capacidad de pago.')->showConfirmButton();
                return redirect('/capacidad_pago/');
            } else {
                $tipo_credito = TipoCredito::all();
                return view('capacidad_pago.create')->with(compact('tipo_credito'));
            }

        }

    }
    public function store(CapacidadPagoFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $capacidad = new CapacidadPago();
        $capacidad->porcentaje = $request->input('porcentaje');
        $capacidad->amortizacion_coop_san_martin = $request->input('amortizacion_coop_san_martin');
        $capacidad->id_persona = $this->id_persona;
        $capacidad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/capacidad_pago')->with(compact('notification'));
    }
    public function edit($id)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $capacidad = CapacidadPago::find($id);
            return view('capacidad_pago.edit')->with(compact('capacidad')); //formulario de registro
        }

    }
    public function update(CapacidadPagoFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $capacidad = CapacidadPago::find($id);
        $capacidad->porcentaje = $request->input('porcentaje');
        $capacidad->amortizacion_coop_san_martin = $request->input('amortizacion_coop_san_martin');
        $capacidad->id_persona = $this->id_persona;
        $capacidad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('/capacidad_pago')->with(compact('notification'));
    }
    public function destroy($id)
    {
        $capa = CapacidadPago::find($id);
        $capa->delete(); //delete
        $notification= 'Exelente los datos se han eliminado'; 
        return back()->with(compact('notification'));
    }
}
