<?php

namespace sis5cs\Http\Controllers;
use Illuminate\Http\Request; 
use sis5cs\Http\Requests\AfpFormRequest;
use sis5cs\Afp;

class AfpController extends Controller
{
		public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		$afp=Afp::All();
		return view('afp.index')->with(compact('afp'));
	}
	public function create()
	{ 
		return view('afp.create');
	}
	public function store(AfpFormRequest $request)
	{
		$afp = new Afp(); 
		$afp->nombre_afp=$request->input('nombre_afp');
		$afp->estado=true;				
		$afp->save(); 		
		$notification= 'Exelente los datos se han guardado correctamente'; 
		return redirect('/afp')->with(compact('notification'));
		

	}

	public function edit($id)
	{
		$afp=Afp::find($id);
        return view('afp.edit')->with(compact('afp')); //formulario de registro
    }
    public function update(AfpFormRequest $request,$id)
    {  	
    	$afp=Afp::find($id); 
    	$afp->nombre_afp=$request->input('nombre_afp');	
     $afp->save(); //metodo se encarga de ejecutar un insert sobre la tabla
     $notification= 'Exelente sus datos se han modificado correctamente';     
     return redirect('/afp/')->with(compact('notification'));

 }

 public function destroy($id)
 {
 	  $afp=Afp::find($id); 
      $afp->delete(); //delete
      return back();
  }
}
