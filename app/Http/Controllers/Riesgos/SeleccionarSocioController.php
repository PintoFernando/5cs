<?php

namespace sis5cs\Http\Controllers\Riesgos;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Persona;
use Session;


class SeleccionarSocioController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
		$personas=Persona::All();
		return view('riesgos.seleccionar.index')->with(compact('personas'));
	} 

	public function seleccionar($id)
	{
		$datos_persona=Persona::where('id_persona',$id)->firstOrFail();
		Session::put('id_persona_oficial',$datos_persona->nombre.' '.$datos_persona->ap_paterno.' '.$datos_persona->ap_materno);
		Session::put('id_persona',$id);
		return view('riesgos.dashboard.index');
	}
}
