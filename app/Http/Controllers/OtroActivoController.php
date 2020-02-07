<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\OtroActivoFormRequest;
use sis5cs\OtroActivo;

class OtroActivoController extends Controller
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
            $activo = OtroActivo::where('id_persona', Session::get('id_persona'))->get();
            return view('otros_activos.index')->with(compact('activo'));

        }
    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            return view('otros_activos.create');
        }

    }

    public function store(OtroActivoFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $ac = new OtroActivo();
        $ac->detalle = $request->input('detalle');
        $ac->en_garantia = $request->input('en_garantia');
        $ac->total = $request->input('total');
        $ac->id_persona = $this->id_persona;
        //$ac->id_tipo_vivienda=$request->input('id_tipo_vivienda');

        $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/otros_activos')->with(compact('notification'));
    }

    public function edit($id)
    {
        $activo = OtroActivo::find($id);
        return view('otros_activos.edit')->with(compact('activo')); //formulario de registro
    }
    public function update(OtroActivoFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $ac = OtroActivo::find($id);
        $ac->detalle = $request->input('detalle');
        $ac->en_garantia = $request->input('en_garantia');
        $ac->total = $request->input('total');
        $ac->id_persona = $this->id_persona;
        $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('otros_activos')->with(compact('notification'));
    }
    public function destroy($id)
    {
        $otro=OtroActivo::find($id);
        $otro->delete();
        return back();
    }
}
