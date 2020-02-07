<?php

namespace sis5cs\Http\Controllers;
use sis5cs\EntidadBancaria;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\EntidadBancariaFormRequest;

class EntidadBancariaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		$entidad=EntidadBancaria::All();
		return view('entidad_bancaria.index')->with(compact('entidad'));
	}	
	public function create()
	{ 
		return view('entidad_bancaria.create');
	}
	public function store(EntidadBancariaFormRequest $request)
	{
		$entidad = new EntidadBancaria(); 
		$entidad->nombre_entidad=$request->input('nombre_entidad');			
		$entidad->save(); 		
		$notification= 'Exelente los datos se han guardado correctamente'; 
		return redirect('/entidad_bancaria')->with(compact('notification'));
	}

	public function edit($id)
	{
		$entidad=EntidadBancaria::find($id);
        return view('entidad_bancaria.edit')->with(compact('entidad')); //formulario de registro
    }
    public function update(EntidadBancariaFormRequest $request,$id)
    {  	
    	$entidad=EntidadBancaria::find($id); 
    	$entidad->nombre_entidad=$request->input('nombre_entidad');	
     	$entidad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
     	$notification= 'Exelente sus datos se han modificado correctamente';     
     	return redirect('/entidad_bancaria/')->with(compact('notification'));

     }

     public function destroy($id)
     {
     	$entidad=EntidadBancaria::find($id); 
      $entidad->delete(); //delete
      return back();
  }
}
