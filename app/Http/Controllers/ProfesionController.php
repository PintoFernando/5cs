<?php

namespace sis5cs\Http\Controllers;
use sis5cs\Profesion;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\ProfesionFormRequest;

class ProfesionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		$profesiones=Profesion::All();
		return view('profesion.index')->with(compact('profesiones'));
	}
	public function create()
	{ 
		return view('profesion.create');
	}
	public function store(ProfesionFormRequest $request)
	{
		$pro = new Profesion(); 
		$pro->profesion=$request->input('profesion');
		$pro->estado=true;				
		$pro->save(); 		
		$notification= 'Exelente los datos se han guardado correctamente'; 
		return redirect('/profesion')->with(compact('notification'));	
	}
	public function edit($id)
	{
		$profesion=Profesion::find($id);
        return view('profesion.edit')->with(compact('profesion')); //formulario de registro
    }
    public function update(ProfesionFormRequest $request,$id)
    {  	
    	$profesion=Profesion::find($id); 
    	$profesion->profesion=$request->input('profesion');	
     $profesion->save(); //metodo se encarga de ejecutar un insert sobre la tabla
     $notification= 'Exelente sus datos se han modificado correctamente';     
     return redirect('/profesion/')->with(compact('notification'));
 }

 public function destroy($id)
 {
 	$profesion=Profesion::find($id); 
    $profesion->delete(); //delete
     return back();
  }
}
