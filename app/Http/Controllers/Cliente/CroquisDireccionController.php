<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

use sis5cs\Http\Requests\CroquisDireccionFormRequest;
use sis5cs\Direccion;
use sis5cs\Persona;
use sis5cs\CroquisDireccion;
use DB;
use Alert;
use Auth;


class CroquisDireccionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    
     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $per=Persona::where('id_persona',$id_persona)->first()->id_persona;
     $direccion=Direccion::where('id_persona',$per)->firstOrFail()->id_direccion; 
         
     $latitud=CroquisDireccion::where('id_direccion',$direccion)->firstOrFail()->latitud;
     $longitud=CroquisDireccion::where('id_direccion',$direccion)->firstOrFail()->longitud;
     return view('cliente.croquis.index',["latitud"=>$latitud,"longitud"=>$longitud]);
   
 }

 public function create()
 {
     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $per=Persona::where('id_persona',$id_persona)->first()->id_persona;   
     $direc=Direccion::where('id_persona',$per)->first()->id_direccion;      
     $cro=CroquisDireccion::where('id_direccion',$direc)->count();  
     if($cro>0)
     {
      alert()->info('Info','Ya registro sus datos de croquis.')->showConfirmButton();
      return redirect('cliente/croquis/');
    }
    else
    {
     return view('cliente.croquis.create');
    }


 }
 public function store(CroquisDireccionFormRequest $request)
 {
     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $id_per=Persona::where('id_persona',$id_persona)->first()->id_persona;
     $direc=Direccion::where('id_persona',$id_per)->first()->id_direccion;   

     $cro= new CroquisDireccion(); 
     $cro->latitud=$request->input('latitud');
     $cro->longitud=$request->input('longitud');
     $cro->id_direccion=$direc;
     $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla

     alert()->success('Exelente','Croquis de dirección agregada correctamente')->showConfirmButton();
     $notification= 'Exelente el croquis ha sido agregada correctamente';     
     return redirect('cliente/croquis/')->with(compact('notification'));
   }
 }
