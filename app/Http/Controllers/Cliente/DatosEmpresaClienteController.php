<?php
namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\DatosEmpresaFormRequest;
use sis5cs\DatosEmpresa;
use sis5cs\TipoContrato;
use sis5cs\Afp;
use sis5cs\Persona;
use DB;
use Alert;
use Auth;

class DatosEmpresaClienteController extends Controller
{
    //variables de clase
  public $id_persona;

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $this->id_persona=Auth::user()->id_persona;   
    $datos = DB::table('datos_empresa')
    ->join('afp', 'datos_empresa.id_afp', '=', 'afp.id_afp')
    ->join('tipo_contrato', 'datos_empresa.id_tc', '=', 'tipo_contrato.id_tc')
    ->select('datos_empresa.*', 'afp.nombre_afp', 'tipo_contrato.nombre_tc')
    ->where('datos_empresa.id_persona',$this->id_persona)
    ->get();
    return view('cliente.datos_empresa.index')->with(compact('datos'));
   }
  public function create()
  {
  	  $tipo_contrato=TipoContrato::All();
  	  $afp=Afp::All();
      //corregir relacion uno a uno esta uno a muchos en: persona-direccion}
       $this->id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
       //dd($this->id_persona);
       $exist=Persona::where('id_persona',$this->id_persona)->count();
       if($exist>0)
       {
       	$per=Persona::where('id_persona',$this->id_persona)->first()->id_persona;
       	$dat=DatosEmpresa::where('id_persona',$per)->count();      
       	if($dat>0)
       	{
       		alert()->info('Info','Ya registro sus datos de empresa.')->showConfirmButton();
       		return redirect('cliente/datos_empresa/');
       	}
       	else
       	{
       		return view('cliente.datos_empresa.create')->with(compact('tipo_contrato','afp'));
       	}
       }
       else
       {
       	alert()->info('Info','Registre sus datos generales antes de llenar este formulario.')->showConfirmButton();
       	return redirect('cliente/datos_empresa/mensaje');
       }  




     }
     public function store(DatosEmpresaFormRequest $request)
     {
      //obtenemos el id del usuario actual del sistema    
       $this->id_persona=Auth::user()->id_persona; 
       $datos= new DatosEmpresa(); 
       $datos->nombre_empresa=$request->input('nombre_empresa');
       $datos->actividad_empresa=$request->input('actividad_empresa');
       $datos->antiguedad_empresa=$request->input('antiguedad_empresa');
       $datos->ciudad_empresa=$request->input('ciudad_empresa');
       $datos->provincia_empresa=$request->input('provincia_empresa');
       $datos->zona_empresa=$request->input('zona_empresa');
       $datos->direccion_empresa=$request->input('direccion_empresa');
       $datos->telefono_empresa=$request->input('telefono_empresa');
       $datos->cargo_en_empresa=$request->input('cargo_en_empresa');
       $datos->antiguedad_en_cargo=$request->input('antiguedad_en_cargo');
       $datos->horario_trabajo=$request->input('horario_trabajo');
       $datos->dias_trabajo=$request->input('dias_trabajo');
       $datos->id_persona=$this->id_persona;
       $datos->id_afp=$request->input('id_afp');
       $datos->id_tc=$request->input('id_tc');
       $datos->save(); //metodo se encarga de ejecutar un insert sobre la tabla

     alert()->success('Exelente','Los datos de la empresa se agregaron correctamente')->showConfirmButton();
     $notification= 'Exelente sus datos de la empresa se añadieron correctamente';     
     return redirect('cliente/datos_empresa/')->with(compact('notification'));
   }
}
