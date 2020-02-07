<?php
namespace sis5cs\Http\Controllers\Oficial;
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
use Session;

class DatosEmpresaController extends Controller
{
 public $id_persona;
 public function __construct()
 {
  $this->middleware('auth');
}
public function index(Request $request)
{
  $this->id_persona=Session::get('id_persona');
  if(Session::get('id_persona')==null)
  {
   alert()->info('Info','Seleccione un socio')->showConfirmButton();
   return redirect('oficial/dashboard/');
 }
    /*else{
      $datos=DatosEmpresa::where('id_persona',Session::get('id_persona'))->get();
      return view('oficial.datos_empresa.index')->with(compact('datos'));
    }*/

    else
    {
      $datos=DB::table('datos_empresa')            
      ->join('afp','datos_empresa.id_afp','=','afp.id_afp')           
      ->join('tipo_contrato','datos_empresa.id_tc','=','tipo_contrato.id_tc')           
      ->select('datos_empresa.*','afp.nombre_afp','tipo_contrato.nombre_tc')
      ->where('id_persona',$this->id_persona)
      ->get();
      return view('oficial.datos_empresa.index')->with(compact('datos')); 
    }

  }
  public function create()
  {    
    if(Session::get('id_persona')==null)
    {
      alert()->info('Info','Seleccione un socio')->showConfirmButton();
      return redirect('oficial/dashboard/');
    }
    else
    {
      $if_exist=DatosEmpresa::where('id_persona',Session::get('id_persona'))->count();
      if($if_exist>3)
      {
        alert()->info('Info','Ya registro los Datos de la Empresa.')->showConfirmButton();
        return redirect('oficial/datos_empresa/');
      }
      else
      {
        $afp=Afp::all();
        $tipo_contrato=TipoContrato::all();
        return view('oficial.datos_empresa.create')
        ->with(compact('afp','tipo_contrato'));
      }
    }
  }
  public function store(DatosEmpresaFormRequest $request)
  {
   $this->id_persona=Session::get('id_persona');  
   $datos = new DatosEmpresa(); 
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
   $datos->id_afp=$request->input('id_afp');
   $datos->id_tc=$request->input('id_tc');
   $datos->id_persona=$this->id_persona;
 $datos->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han guardado correctamente'; 
 return redirect('oficial/datos_empresa')->with(compact('notification'));
}

public function edit($id)
{
 $datos=DatosEmpresa::find($id);
 $afp=Afp::All();
 $tipo=TipoContrato::All();
      return view('oficial.datos_empresa.edit')->with(compact('datos','afp','tipo')); //formulario de registro
    }
    public function update(DatosEmpresaFormRequest $request,$id)
    {
     $this->id_persona=Session::get('id_persona');
     $datos=DatosEmpresa::find($id); 
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
     $notification= 'Exelente sus datos se han modificado correctamente';     
     return redirect('oficial/datos_empresa/')->with(compact('notification'));

   }


  }
