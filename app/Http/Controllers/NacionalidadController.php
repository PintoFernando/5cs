<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use sis5cs\Http\Requests\NacionalidadFormRequest;
use sis5cs\Nacionalidad;

class NacionalidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $nacionalidad = Nacionalidad::All();
        return view('nacionalidad.index')->with(compact('nacionalidad'));
    }
    public function create()
    {
        return view('nacionalidad.create');
    }
    public function store(NacionalidadFormRequest $request)
    {
        $nacionalidad = new Nacionalidad();
        $nacionalidad->nacionalidad = $request->input('nacionalidad');
        $nacionalidad->estado = true;
        $nacionalidad->save();
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/nacionalidad')->with(compact('notification'));

    }
    public function edit($id)
    {
        $nacionalidad = Nacionalidad::find($id);
        return view('nacionalidad.edit')->with(compact('nacionalidad')); //formulario de registro
    }
    public function update(NacionalidadFormRequest $request, $id)
    {
        $nacionalidad = Nacionalidad::find($id);
        $nacionalidad->nacionalidad = $request->input('nacionalidad');
        $nacionalidad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos se han modificado correctamente';
        return redirect('/nacionalidad/')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $nacionalidad = Nacionalidad::find($id);
        $nacionalidad->delete(); //delete
        return back();
    }
}
