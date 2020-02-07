<?php

namespace sis5cs\Http\Controllers\Oficial;

use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\BienesHogar;
use sis5cs\Persona;
use sis5cs\Http\Requests\BienesHogarFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use Session;

class BienesHogarGaranteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if(Session::get('id_persona_garante')==null)
        {
            alert()->info('Info', 'Seleccione un Garante')->showConfirmButton();
            return redirect('oficial/garante/');
        }
        else
        {
            $bienes =BienesHogar::where('id_persona',Session::get('id_persona_garante'))->get();
            return view('oficial.a_garantes.bienes_hogar.index')->with(compact('bienes'));
        }
    }
    public function create()
    {
        if(Session::get('id_persona_garante')==null)
        {
            alert()->info('Info', 'Seleccione un Garante')->showConfirmButton();
            return redirect('oficial/garante/');
        }
        else
        {           
          return view('oficial.a_garantes.bienes_hogar.create');
        }       
    }
    public function store(BienesHogarFormRequest $request)
    {
           
        $bi = new BienesHogar();
        $bi->articulo = $request->input('articulo');
        $bi->descripcion = $request->input('descripcion');
        $bi->marca = $request->input('marca');
        $bi->color = $request->input('color');
        $bi->modelo = $request->input('modelo');
        $bi->estado = $request->input('estado');
        $bi->valor = $request->input('valor');
        $bi->id_persona = Session::get('id_persona_garante');
        $bi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification= 'Exelente los datos se han guardado correctamente';     
        return redirect('oficial/a_garantes/bienes_hogar/')->with(compact('notification'));
        
    }

    public function edit($id)
    {
        $bienes = BienesHogar::find($id);
        return view('oficial.a_garantes.bienes_hogar.edit')->with(compact('bienes')); //formulario de registro
    }
    public function update(BienesHogarFormRequest $request, $id)
    {
        $bi = BienesHogar::find($id);
        $bi->articulo = $request->input('articulo');
        $bi->descripcion = $request->input('descripcion');
        $bi->marca = $request->input('marca');
        $bi->color = $request->input('color');
        $bi->modelo = $request->input('modelo');
        $bi->estado = $request->input('estado');
        $bi->valor = $request->input('valor');
        $bi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        return redirect('oficial/a_garantes/bienes_hogar/');
    }
}
