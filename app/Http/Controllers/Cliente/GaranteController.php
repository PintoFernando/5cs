<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Persona;
use sis5cs\Garante;
use sis5cs\Profesion;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\GaranteFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use Auth;
use Alert;

class GaranteController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
     
     public function index(Request $request)
  {
    
     $id_persona=Auth::user()->id_persona; 
     $garan=Garante::where('id_persona',$id_persona)->first()->garante;    
     $garant=Persona::where('id_persona',$garan)->first();    
     return view('cliente.garante.index',["garant"=>$garant]);
   
 }

 public function create()
 {
     $profesiones=Profesion::All();
     $id_persona=Auth::user()->id_persona; 
     $per=Persona::where('id_persona',$id_persona)->first()->id_persona;
     $conyu=Garante::where('id_persona',$per)->count();
     if($conyu>0)
     {
       alert()->info('Info','Ya se registro los datos de garante.')->showConfirmButton();
      return redirect('cliente/garante/');
     }
    else
    {
      $profesiones=Profesion::all();   
      return view('cliente.garante.create')->with(compact('profesiones'));
    }
 }
 public function store(PersonaFormRequest $request)
 {
    $id_per=Auth::user()->id_persona; 
    $persona= new Persona();      
    $persona->ci=$request->input('ci');
    $persona->nombre=$request->input('nombre');
    $persona->ap_paterno=$request->input('ap_paterno');
    $persona->ap_materno=$request->input('ap_materno');
    $persona->ap_casada=$request->input('ap_casada');
    $persona->fec_nac=$request->input('fec_nac');
    $persona->genero=$request->input('genero');
    $persona->celular=$request->input('celular');
    $persona->dependientes=$request->input('dependientes');
    $persona->id_estado_civil=1;
    $persona->id_profesion=$request->input('id_profesion');
    $persona->save(); 
    
    $garante=new Garante();
    $garante->id_persona=$id_per;// obtener el id de la fila insertada
    $garante->garante=$persona->id_persona;// obtener el id de la fila insertada
    $garante->save();

      alert()->success('Exelente','Exelente los datos de su garante se añadieron correctamente')->showConfirmButton();
      $notification= 'Exelente sus datos se han agregado correctamente';     
      return redirect('cliente/garante/')->with(compact('notification'));
   }
}
