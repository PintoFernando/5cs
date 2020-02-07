<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use sis5cs\Http\Requests\OtroActivoFormRequest;
use sis5cs\OtroActivo;
use sis5cs\Persona;

class OtroActivoGaranteController extends Controller
{
	public $id_persona_garante;
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		$this->id_persona_garante=Session::get('id_persona_garante');
		if(Session::get('id_persona_garante')==null)
			{
				alert()->info('Info','Seleccione un Garante')->showConfirmButton();
				return redirect('oficial/garante/');
			}
			else
			{
				$activo=OtroActivo::where('id_persona',Session::get('id_persona_garante'))->get();
				return view('oficial.a_garantes.otros_activos.index')->with(compact('activo'));

			}
		}
		public function create()
		{    
			if(Session::get('id_persona_garante')==null)
				{
					alert()->info('Info','Seleccione un garante')->showConfirmButton();
					return redirect('oficial/garante/');
				}

				else

				{      
					return view('oficial.a_garantes.otros_activos.create');
				} 


			}

			public function store(OtroActivoFormRequest $request)
			{
				$this->id_persona_garante=Session::get('id_persona_garante');  
				$ac = new OtroActivo(); 
				$ac->detalle=$request->input('detalle');
				$ac->en_garantia=$request->input('en_garantia');
				$ac->total=$request->input('total');
				$ac->id_persona=$this->id_persona_garante;
 //$ac->id_tipo_vivienda=$request->input('id_tipo_vivienda');
 $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han guardado correctamente'; 
 return redirect('oficial/a_garantes/otros_activos')->with(compact('notification'));
}

public function edit($id)
{
	$activo=OtroActivo::find($id);
      return view('oficial.a_garantes.otros_activos.edit')->with(compact('activo')); //formulario de registro
  }
  public function update(OtroActivoFormRequest $request,$id)
  {
  	$this->id_persona_garante=Session::get('id_persona_garante');
  	$ac=OtroActivo::find($id); 
  	$ac->detalle=$request->input('detalle');
  	$ac->en_garantia=$request->input('en_garantia');
  	$ac->total=$request->input('total');
  	$ac->id_persona=$this->id_persona_garante;
    $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification= 'Exelente los datos se han modificado correctamente'; 
    return redirect('oficial/a_garantes/otros_activos')->with(compact('notification'));
}
}
