<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\DireccionFormRequest;
use sis5cs\Direccion;
use sis5cs\TipoVivienda;
use sis5cs\Persona;
use sis5cs\CroquisDireccion;
use DB;
Use Alert;
use Auth;

class DireccionController extends Controller
{
 public function __construct()
 {
  $this->middleware('auth');
}
public function index(Request $request)
{
     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $per=Persona::where('id_persona',$id_persona)->first()->id_persona;
     $direccion=Direccion::where('id_persona',$per)->firstOrFail(); 
     $tipo_vivienda=TipoVivienda::where('id_tipo_vivienda',$direccion->id_tipo_vivienda)->first()->tipo_vivienda;
     return view('cliente.direccion.index')->with(compact('direccion'))->with('tipo_vivienda',$tipo_vivienda); 

   }
   public function mensaje()
   {
    return view('cliente.direccion.mensaje');
  }

  public function create()
  {


      //corregir relacion uno a uno esta uno a muchos en: persona-direccion}
       $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
       $exist=Persona::where('id_persona',$id_persona)->count();
       if($exist>0)
       {
        $per=Persona::where('id_persona',$id_persona)->first()->id_persona;
        $direc=Direccion::where('id_persona',$per)->count();      
        if($direc>0)
        {
          alert()->info('Info','Ya registro sus datos de dirección.')->showConfirmButton();
          return redirect('cliente/direccion/');
        }
        else
        {
         $croquis=CroquisDireccion::All();
         $tipo=TipoVivienda::All();
         $personas=Persona::All();
         return view('cliente.direccion.create')->with(compact('croquis','tipo','personas'));
       }
     }
     else
     {
      alert()->info('Info','Registre sus datos generales antes de llenar este formulario.')->showConfirmButton();
      return redirect('cliente/direccion/mensaje');
    }
  }
  public function store(DireccionFormRequest $request)
  {
     $id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema    

     $dire= new Direccion(); 
     $dire->direc_numero=$request->input('direc_numero');
     $dire->ciudad=$request->input('ciudad');
     $dire->provincia=$request->input('provincia');
     $dire->localidad=$request->input('localidad');
     $dire->zona=$request->input('zona');
     $dire->distrito=$request->input('distrito');
     $dire->barrio=$request->input('barrio');
     $dire->cll_principal=$request->input('cll_principal');
     $dire->cll_secundaria=$request->input('cll_secundaria');
     $dire->tiempo_residencia=$request->input('tiempo_residencia');
     $dire->id_persona=$id_persona;
     $dire->id_tipo_vivienda=$request->input('id_tipo_vivienda');
     $dire->save(); //metodo se encarga de ejecutar un insert sobre la tabla

      alert()->success('Exelente','Dirección agregada correctamente')->showConfirmButton();
      $notification= 'Exelente la dirección ha sido creada correctamente';     
      return redirect('cliente/direccion/')->with(compact('notification'));
    }

    public function edit($id)
    {
      $direc=Direccion::find($id);
      $tipo=TipoVivienda::All();
      $croquis=Croquis::All();
      $persona=Persona::All();
      return view('direccion.crud.edit')->with(compact('direc','tipo','croquis','persona')); //formulario de registro
    }
    /*public function update(DireccionFormRequest $request,$id)
    {
      // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array

      $dire=Direccion::find($id); 
      $dire->direc_numero=$request->input('direc_numero');
      $dire->ciudad=$request->input('ciudad');
      $dire->provincia=$request->input('provincia');
      $dire->localidad=$request->input('localidad');
      $dire->zona=$request->input('zona');
      $dire->distrito=$request->input('distrito');
      $dire->barrio=$request->input('barrio');
      $dire->cll_principal=$request->input('cll_principal');
      $dire->cll_secundaria=$request->input('cll_secundaria');
      $dire->tiempo_residencia=$request->input('tiempo_residencia');
      $dire->id_persona=$request->input('id_persona');
      $dire->id_croquis=$request->input('id_croquis');
      $dire->id_tipo_vivienda=$request->input('id_tipo_vivienda');
      $dire->save(); //metodo se encarga de ejecutar un insert sobre la tabla
     return redirect('/direccion/crud');
   }*/

 }
