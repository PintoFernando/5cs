<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Persona;
use Session;

class SeleccionarGaranteController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function seleccionar($id)
	{
		$datos_persona=Persona::where('id_persona',$id)->firstOrFail();
		Session::put('id_persona_oficial_garante',$datos_persona->nombre.' '.$datos_persona->ap_paterno.' '.$datos_persona->ap_materno);
		Session::put('id_persona_garante',$id);
		$notification= 'Exelente se ha seleccionado al garante correctamente.';
		return redirect('oficial/garante/')->with(compact('notification'));
	}
}
