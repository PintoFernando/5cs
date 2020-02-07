<?php
namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\InmuebleFormRequest;
use sis5cs\Inmueble;

class InmuebleController extends Controller
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
            $inmuebles = Inmueble::where('id_persona', Session::get('id_persona'))->get();
            return view('inmueble.index')->with(compact('inmuebles'));

        }

    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $inmuebles = Inmueble::all();
            return view('inmueble.create')
                ->with(compact('inmuebles'));
        }}

    public function store(InmuebleFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $in = new Inmueble();
        $in->ciudad = $request->input('ciudad');
        $in->calle = $request->input('calle');
        $in->numero = $request->input('numero');
        $in->zona = $request->input('zona');
        $in->num_folio_real = $request->input('num_folio_real');
        $in->fecha_registro = $request->input('fecha_registro');
        $in->en_garantia = $request->input('en_garantia');
        $in->valor = $request->input('valor');
        $in->id_persona = $this->id_persona;
        //$in->id_persona=$request->input('id_persona');
        $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla return redirect('oficial/direccion');
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/inmueble')->with(compact('notification'));
    }

    public function edit($id)
    {
        $in = Inmueble::find($id);
        return view('inmueble.edit')->with(compact('in')); //formulario de registro
    }
    public function update(InmuebleFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $in = Inmueble::find($id);
        $in->ciudad = $request->input('ciudad');
        $in->calle = $request->input('calle');
        $in->numero = $request->input('numero');
        $in->zona = $request->input('zona');
        $in->num_folio_real = $request->input('num_folio_real');
        $in->fecha_registro = $request->input('fecha_registro');
        $in->en_garantia = $request->input('en_garantia');
        $in->valor = $request->input('valor');
        $in->id_persona = $this->id_persona;
        $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('/inmueble')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $in = Inmueble::find($id);
        $in->delete(); //delete
        return back();
    }
}
