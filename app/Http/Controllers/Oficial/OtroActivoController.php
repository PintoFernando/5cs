<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use sis5cs\Http\Requests\OtroActivoFormRequest;
use sis5cs\OtroActivo;
use sis5cs\Persona;

class OtroActivoController extends Controller
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
       alert()->info('Info','Seleccione un Socio')->showConfirmButton();
       return redirect('oficial/dashboard/');
     }
     else
     {
      $activo=OtroActivo::where('id_persona',Session::get('id_persona'))->get();
      return view('oficial.otros_activos.index')->with(compact('activo'));

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
       return view('oficial.otros_activos.create');
     } 


   }

   public function store(OtroActivoFormRequest $request)
   {
     $this->id_persona=Session::get('id_persona');  
     $ac = new OtroActivo(); 
     $ac->detalle=$request->input('detalle');
     $ac->en_garantia=$request->input('en_garantia');
     $ac->total=$request->input('total');
     $ac->id_persona=$this->id_persona;
 //$ac->id_tipo_vivienda=$request->input('id_tipo_vivienda');

 $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han guardado correctamente'; 
 return redirect('oficial/otros_activos')->with(compact('notification'));
}

public function edit($id)
{
 $activo=OtroActivo::find($id);
      return view('oficial.otros_activos.edit')->with(compact('activo')); //formulario de registro
    }
    public function update(OtroActivoFormRequest $request,$id)
    {
     $this->id_persona=Session::get('id_persona');
     $ac=OtroActivo::find($id); 
     $ac->detalle=$request->input('detalle');
     $ac->en_garantia=$request->input('en_garantia');
     $ac->total=$request->input('total');
     $ac->id_persona=$this->id_persona;
 $ac->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han modificado correctamente';
 return redirect('oficial/otros_activos')->with(compact('notification'));
}


}
