<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use sis5cs\Http\Requests\InventarioMercaderiaFormRequest;
use sis5cs\Persona;
use sis5cs\InventarioMercaderia;
use sis5cs\User;
use Maatwebsite\Excel\Facades\Excel;

class InventarioMercaderiaGaranteController extends Controller
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
     alert()->info('Info','Seleccione un Garante')->showConfirmButton();
     return redirect('oficial/garante/');
   }
   else
   {
    $inventario=InventarioMercaderia::where('id_persona',Session::get('id_persona_garante'))->get();
    return view('oficial.a_garantes.inventario_mercaderia.index')->with(compact('inventario'));

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
  $inventario=InventarioMercaderia::all();
  return view('oficial.a_garantes.inventario_mercaderia.create')
        ->with(compact('inventario'));
}}

public function store(InventarioMercaderiaFormRequest $request)
{
      $this->id_persona_garante=Session::get('id_persona_garante');  
      $in= new InventarioMercaderia(); 
      $in->detalle=$request->input('detalle');
      $in->cantidad=$request->input('cantidad');
      $in->unidad_medida=$request->input('unidad_medida');
      $in->precio_unitario=$request->input('precio_unitario');
      $in->total=$request->input('total');
      $in->id_persona=$this->id_persona_garante;
      $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla return redirect('oficial/direccion');
      $notification= 'Exelente los datos se han guardado correctamente'; 
      return redirect('oficial/a_garantes/inventario_mercaderia')->with(compact('notification'));
}

public function edit($id)
{
    $inventario=InventarioMercaderia::find($id);
      return view('oficial.a_garantes.inventario_mercaderia.edit')->with(compact('inventario')); //formulario de registro
    }
    public function update(InventarioMercaderiaFormRequest $request,$id)
    {
      $this->id_persona_garante=Session::get('id_persona_garante');
      $in=InventarioMercaderia::find($id); 
      $in->detalle=$request->input('detalle');
      $in->cantidad=$request->input('cantidad');
      $in->unidad_medida=$request->input('unidad_medida');
      $in->precio_unitario=$request->input('precio_unitario');
      $in->total=$request->input('total');
      $in->id_persona=$this->id_persona_garante;

     $in->save(); //metodo se encarga de ejecutar un insert sobre la tabla
     $notification= 'Exelente los datos se han modificado correctamente'; 
     return redirect('oficial/a_garantes/inventario_mercaderia')->with(compact('notification'));
}
    /*-------------
    public function destroy($id)
    {

     $cro=Croquis::find($id); 
      $cro->delete(); //delete
      return back();
    }--------------*/
}
