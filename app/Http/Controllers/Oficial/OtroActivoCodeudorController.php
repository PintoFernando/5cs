<?php

namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\OtroActivoFormRequest;
use sis5cs\OtroActivo;

class OtroActivoCodeudorController extends Controller
{
    public $id_persona_codeudor;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un Codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $activo = OtroActivo::where('id_persona', Session::get('id_persona_codeudor'))->get();
            return view('oficial.a_codeudores.otros_activos.index')->with(compact('activo'));

        }
    }
    public function create()
    {
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            return view('oficial.a_codeudores.otros_activos.create');
        }

    }

    public function store(OtroActivoFormRequest $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $ac = new OtroActivo();
        $ac->detalle = $request->input('detalle');
        $ac->en_garantia = $request->input('en_garantia');
        $ac->total = $request->input('total');
        $ac->id_persona = $this->id_persona_codeudor;
        //$ac->id_tipo_vivienda=$request->input('id_tipo_vivienda');

        $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/a_codeudores/otros_activos')->with(compact('notification'));
    }

    public function edit($id)
    {
        $activo = OtroActivo::find($id);
        return view('oficial.a_codeudores.otros_activos.edit')->with(compact('activo')); //formulario de registro
    }
    public function update(OtroActivoFormRequest $request, $id)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $ac = OtroActivo::find($id);
        $ac->detalle = $request->input('detalle');
        $ac->en_garantia = $request->input('en_garantia');
        $ac->total = $request->input('total');
        $ac->id_persona = $this->id_persona_codeudor;
        $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('oficial/a_codeudores/otros_activos')->with(compact('notification'));
    }
}
