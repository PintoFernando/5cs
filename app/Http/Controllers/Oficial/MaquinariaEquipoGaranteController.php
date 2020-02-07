<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use sis5cs\Http\Requests\MaquinariaEquipoFormRequest;
use sis5cs\MaquinariaEquipo;
use sis5cs\Persona;

class MaquinariaEquipoGaranteController extends Controller
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
     alert()->info('Info','Seleccione un garante')->showConfirmButton();
     return redirect('oficial/garante/');
   }
   else
   {
    $maquinaria=MaquinariaEquipo::where('id_persona',Session::get('id_persona_garante'))->get();
    return view('oficial.a_garantes.maquinaria_equipo.index')->with(compact('maquinaria'));
   }
}
public function create()
{    
 if(Session::get('id_persona_garante')==null)
 {
   alert()->info('Info','Seleccione un Garante')->showConfirmButton();
   return redirect('oficial/garante/');
 }
 
 else
 {
   $if_exist=MaquinariaEquipo::where('id_persona',Session::get('id_persona_garante'))->count();
   if($if_exist>100)
   {
     alert()->info('Info','Ya registro las datos de maquinaria equipo')->showConfirmButton();
     return redirect('oficial/a_garantes/maquinaria_equipo/');
   }
   else
   {      
     return view('oficial.a_garantes.maquinaria_equipo.create');
   } 

 }
}

public function store(MaquinariaEquipoFormRequest $request)
{
 $this->id_persona_garante=Session::get('id_persona_garante');  
 $ma = new MaquinariaEquipo(); 
 $ma->descripcion=$request->input('descripcion');
 $ma->marca=$request->input('marca');
 $ma->modelo=$request->input('modelo');
 $ma->anio=$request->input('anio');
 $ma->asegurado=$request->input('asegurado');
 $ma->aseguradora=$request->input('aseguradora');
 $ma->entidad_acreedora=$request->input('entidad_acreedora');
 $ma->total=$request->input('total');
 $ma->id_persona=$this->id_persona_garante;
 //$ma->id_tipo_vivienda=$request->input('id_tipo_vivienda');
 $ma->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han guardado correctamente'; 
 return redirect('oficial/a_garantes/maquinaria_equipo');
}

public function edit($id)
{
 $maquinaria=MaquinariaEquipo::find($id);
      return view('oficial.a_garantes.maquinaria_equipo.edit')->with(compact('maquinaria')); //formulario de registro
    }
    public function update(MaquinariaEquipoFormRequest $request,$id)
    {
     $this->id_persona_garante=Session::get('id_persona_garante');
     $maquinaria=MaquinariaEquipo::find($id); 
     $maquinaria->descripcion=$request->input('descripcion');
     $maquinaria->marca=$request->input('marca');
     $maquinaria->modelo=$request->input('modelo');
     $maquinaria->anio=$request->input('anio');
     $maquinaria->asegurado=$request->input('asegurado');
     $maquinaria->aseguradora=$request->input('aseguradora');
     $maquinaria->entidad_acreedora=$request->input('entidad_acreedora');
     $maquinaria->total=$request->input('total');
     $maquinaria->id_persona=$this->id_persona_garante;
 $maquinaria->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han modificado correctamente'; 
 return redirect('oficial/a_garantes/maquinaria_equipo');
}
}
