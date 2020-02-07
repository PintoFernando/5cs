<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use sis5cs\ReferenciaSolicitante;
use sis5cs\Http\Requests\ReferenciaSolicitanteFormRequest;

class ReferenciaSolicitanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $referencias = ReferenciaSolicitante::where('id_persona', Session::get('id_persona'))
            ->where('estado',true)            
            ->get();
            return view('referencias_solicitante.index')->with(compact('referencias'));
        }

    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            return view('referencias_solicitante.create');
        }

    }

    public function store(ReferenciaSolicitanteFormRequest $request)
    {        
        $re = new ReferenciaSolicitante();
        $re->ap_paterno = $request->input('ap_paterno');
        $re->ap_materno = $request->input('ap_materno');
        $re->nombre = $request->input('nombre');
        $re->parentesco = $request->input('parentesco');
        $re->celular = $request->input('celular');
        $re->telefono = $request->input('telefono');
        $re->estado = true;
        $re->id_persona = Session::get('id_persona');
        $re->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification= 'Exelente los datos se han guardado correctamente';
        return redirect('referencias_solicitante')->with(compact('notification'));
    }

    public function edit($id)
    {
        $refe = ReferenciaSolicitante::find($id);
        return view('referencias_solicitante.edit')->with(compact('refe'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'ap_paterno'=>'nullable|string',
            'ap_materno'=>'nullable|string',
            'nombre'=>'nullable|string',
            'parentesco'=>'nullable|string',
            'celular'=>'nullable|numeric',
            'telefono'=>'nullable|numeric'
        ]);

        $re = ReferenciaSolicitante::find($id);
        $re->ap_paterno = $request->input('ap_paterno');
        $re->ap_materno = $request->input('ap_materno');
        $re->nombre = $request->input('nombre');
        $re->parentesco = $request->input('parentesco');
        $re->celular = $request->input('celular');
        $re->telefono = $request->input('telefono');
        $re->save(); //metodo se encarga de ejecutar un insert sobre la tabla

        $notification= 'Exelente los datos se han modificado correctamente'; 
        return redirect('/referencias_solicitante')->with(compact('notification'));
    }

    public function destroy($id)
    {
      $refe= ReferenciaSolicitante::find($id); 
      $refe->delete(); //delete      
      return back();
  }
}
