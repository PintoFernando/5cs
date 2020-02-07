<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Persona;
use Session;

class SeleccionarCodeudorController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}	
	public function seleccionar($id)
	{

		$datos_persona=Persona::where('id_persona',$id)->firstOrFail();
		Session::put('id_persona_oficial_codeudor',$datos_persona->nombre.' '.$datos_persona->ap_paterno.' '.$datos_persona->ap_materno);
		Session::put('id_persona_codeudor',$id);
		$notification= 'Exelente se ha seleccionado al codeudor correctamente.';
		return redirect('oficial/codeudor/')->with(compact('notification'));		
		
	}
}
