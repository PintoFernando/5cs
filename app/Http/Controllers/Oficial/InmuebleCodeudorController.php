<?php

namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\InmuebleFormRequest;
use sis5cs\Inmueble;

class InmuebleCodeudorController extends Controller
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
            alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $inmuebles = Inmueble::where('id_persona', Session::get('id_persona_codeudor'))->get();
            return view('oficial.a_codeudores.inmueble.index')->with(compact('inmuebles'));

        }

    }

    public function create()
    {
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $inmuebles = Inmueble::all();
            return view('oficial.a_codeudores.inmueble.create')
                ->with(compact('inmuebles'));
        }}

    public function store(InmuebleFormRequest $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $in = new Inmueble();
        $in->ciudad = $request->input('ciudad');
        $in->calle = $request->input('calle');
        $in->numero = $request->input('numero');
        $in->zona = $request->input('zona');
        $in->num_folio_real = $request->input('num_folio_real');
        $in->fecha_registro = $request->input('fecha_registro');
        $in->en_garantia = $request->input('en_garantia');
        $in->valor = $request->input('valor');
        $in->id_persona = $this->id_persona_codeudor;
        //$in->id_persona=$request->input('id_persona');
        $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla return redirect('oficial/direccion');
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/a_codeudores/inmueble')->with(compact('notification'));
    }

    public function edit($id)
    {
        $in = Inmueble::find($id);
        return view('oficial.a_codeudores.inmueble.edit')->with(compact('in')); //formulario de registro
    }
    public function update(InmuebleFormRequest $request, $id)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $in = Inmueble::find($id);
        $in->ciudad = $request->input('ciudad');
        $in->calle = $request->input('calle');
        $in->numero = $request->input('numero');
        $in->zona = $request->input('zona');
        $in->num_folio_real = $request->input('num_folio_real');
        $in->fecha_registro = $request->input('fecha_registro');
        $in->en_garantia = $request->input('en_garantia');
        $in->valor = $request->input('valor');
        $in->id_persona = $this->id_persona_codeudor;
        $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('oficial/a_codeudores/inmueble')->with(compact('notification'));
    }
    /*-------------
public function destroy($id)
{

$cro=Croquis::find($id);
$cro->delete(); //delete
return back();
}--------------*/
}
