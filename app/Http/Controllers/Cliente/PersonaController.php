<?php
namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use sis5cs\Persona;
use sis5cs\Profesion;
use sis5cs\TipoCredito;
use sis5cs\Requisitos;
use sis5cs\User;
use sis5cs\Nacionalidad;
use sis5cs\EstadoCivil;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use Fpdf;
use Auth;
use Alert;
class PersonaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public $id_tcredito;
  public function index(Request $request)
  {
     $id_user=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $persona=Persona::where('id_persona',$id_user)->first();
     $pais=Nacionalidad::where('id_nacionalidad',$persona->id_nacionalidad)->first()->nacionalidad;
     $profesion=Profesion::where('id_profesion',$persona->id_profesion)->first()->profesion;
     $civil=EstadoCivil::where('id_estado_civil',$persona->id_estado_civil)->first()->estado_civil;
     return view('cliente.persona.index')->with(compact('persona'))->with('pais',$pais)->with('profesion',$profesion)->with('civil',$civil);
   }

   public function create()
   {
     $id_user=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema
     $per=Persona::where('id_persona',$id_user)->count();
     if($per>0)
     {
      alert()->info('Info','Ya registro sus datos personales.')->showConfirmButton();
      return redirect('cliente/persona/');
    }
    else
    {
      $profesiones=Profesion::all();   
      $nacionalidades=Nacionalidad::all();   
      $estados=EstadoCivil::all();   
      return view('cliente.persona.create')->with(compact('profesiones','nacionalidades','estados'));
    } 
  }

  public function store(PersonaFormRequest $request)
  {
       // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
    $persona = new Persona(); 
   $persona->ci=$request->input('ci');
   $persona->nombre=$request->input('nombre');
   $persona->ap_paterno=$request->input('ap_paterno');
   $persona->ap_materno=$request->input('ap_materno');
   $persona->ap_casada=$request->input('ap_casada');
   $persona->fec_nac=$request->input('fec_nac');
   $persona->lugar_nac=$request->input('lugar_nac');
   $persona->genero=$request->input('genero');
   $persona->celular=$request->input('celular');
   $persona->dependientes=$request->input('dependientes');
   $persona->id_profesion=$request->input('id_profesion');
   $persona->id_estado_civil=$request->input('id_estado_civil');
   $persona->id_nacionalidad=$request->input('id_nacionalidad');
   $persona->save(); //metodmetodo se encarga de ejecutar un insert sobre la tabla
  
    $id_user=Auth::user()->id_users;//buscamos id_users
    $usuario= User::find($id_user);
    $usuario->id_persona=$persona->id_persona;
    $usuario->save();
    alert()->success('Exelente','Exelente sus datos personales se han agregado correctamente')->showConfirmButton();
      $notification= 'Exelente sus datos se han agregado correctamente';     
      return redirect('cliente/persona/')->with(compact('notification'));
    }


    public function seleccionar(Request $request)
    {
      if ($request)
      {
       $this->id_tcredito=$request->input('id_tcredito');
       $requisitos=DB::table('requisitos')
       ->where('id_tcredito','=',$this->id_tcredito)
       ->get();
       $tipocredito=TipoCredito::all();
      //->paginate(7);
       return view('cliente.requisitos.seleccionar',["requisitos"=>$requisitos,"id"=>$this->id_tcredito,"tipocredito"=>$tipocredito]);
     }
   }
   public function simulador(Request $request)
   {
     return view('vcliente.registrar.simulador');
   }     

 }
