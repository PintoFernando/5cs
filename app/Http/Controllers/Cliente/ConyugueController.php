<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Conyugue;
use sis5cs\Persona;
use sis5cs\Profesion;
use sis5cs\Nacionalidad;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\ConyugueFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use Auth;
use Alert;
class ConyugueController extends Controller
{
     public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(Request $request)
  {    
     $id_persona=Auth::user()->id_persona; 
   $conyug=Conyugue::where('id_persona',$id_persona)->first()->conyugue;    
   $conyu =DB::table('persona')
   ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
   ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
   ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
   ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion','estado_civil.estado_civil')
   ->where('id_persona',$conyug)
   ->get();
   return view('cliente.conyugue.index',["conyu"=>$conyu]);
   
 }

 public function create()
 {
     $profesiones=Profesion::All();
     $id_persona=Auth::user()->id_persona; 
     $per=Persona::where('id_persona',$id_persona)->first()->id_persona;
     $conyu=Conyugue::where('id_persona',$per)->count();
     if($conyu>0)
     {
      alert()->info('Info','Ya registro los datos de su conyugue.')->showConfirmButton();
      return redirect('cliente/conyugue/');
     }
    else
    {
      $profesiones=Profesion::all();
      $nacionalidad=Nacionalidad::all();  

      return view('cliente.conyugue.create')->with(compact('profesiones','nacionalidad'));
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
    $persona->id_nacionalidad=$request->input('id_nacionalidad');
    $persona->lugar_nac=$request->input('lugar_nac');
    $persona->genero=$request->input('genero');
    $persona->celular=$request->input('celular');
    $persona->dependientes=$request->input('dependientes');
    $persona->id_estado_civil=1;
    $persona->id_profesion=$request->input('id_profesion');
    $persona->save(); 
    
    $conyugue=new Conyugue();
    $conyugue->id_persona=$id_per;// obtener el id de la fila insertada
    $conyugue->conyugue=$persona->id_persona;// obtener el id de la fila insertada
    $conyugue->save();

    alert()->success('Exelente','Exelente los datos de su conyugue se añadieron correctamente')->showConfirmButton();
    $notification= 'Exelente sus datos se han agregado correctamente';     
    return redirect('cliente/conyugue/')->with(compact('notification'));
   }
     
}
