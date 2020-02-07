<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\CroquisFormRequest;
use sis5cs\Direccion;
use sis5cs\Persona;
use sis5cs\Croquis;
use sis5cs\CategoriaCroquis;
use DB;
use Alert;
use Auth;
use Session;

class CroquisCodeudorController extends Controller
{
	public function __construct()
 {
  $this->middleware('auth');
}
public function index(Request $request)
{
  if (Session::get('id_persona_codeudor') == null) {
    alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
    return redirect('oficial/codeudor/');
  }else
  {
   $croquis=DB::table('croquis')
   ->join('categoria_croquis', 'croquis.id_categoria_croquis', '=', 'categoria_croquis.id_categoria_croquis')
   ->select('croquis.*', 'categoria_croquis.categoria')
   ->where('id_persona',Session::get('id_persona_codeudor'))
   ->get();
   return view('oficial.a_codeudores.croquis.index')->with(compact('croquis'));
 }
 
}

public function create()
{
  if (Session::get('id_persona_codeudor') == null) {
    alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
    return redirect('oficial/codeudor/');
  } else {
    $categoria=CategoriaCroquis::All();
    return view('oficial.a_codeudores.croquis.create')->with(compact('categoria'));
  }

}


public function store(CroquisFormRequest $request)
{ 
  if($request->input('id_categoria_croquis')==1)
  {
   $cro = Croquis::where('id_persona', Session::get('id_persona_codeudor'))->where('id_categoria_croquis',1)->count();
   if ($cro >=1){
    alert()->info('Info', 'Ya registro sus datos de croquis dirección.')->showConfirmButton();
    return redirect('oficial/a_codeudores/croquis/');
  }else
  {

    $cro = new Croquis();
    $cro->latitud = $request->input('latitud');
    $cro->longitud = $request->input('longitud');
    $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
    $cro->id_persona =Session::get('id_persona_codeudor'); ;
    $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification = 'Exelente el croquis ha sido agregada correctamente';
    return redirect('oficial/a_codeudores/croquis/')->with(compact('notification'));
  }

}

if($request->input('id_categoria_croquis')==2)
{
 $cro1 = Croquis::where('id_persona', Session::get('id_persona_codeudor'))->where('id_categoria_croquis',2)->count();
 if ($cro1 >=1){
  alert()->info('Info', 'Ya registro sus datos de croquis de empresa de trabajo.')->showConfirmButton();
  return redirect('oficial/a_codeudores/croquis/');
}else{

  $cro = new Croquis();
  $cro->latitud = $request->input('latitud');
  $cro->longitud = $request->input('longitud');
  $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
  $cro->id_persona =Session::get('id_persona_codeudor'); ;
    $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification = 'Exelente el croquis ha sido agregada correctamente';
    return redirect('oficial/a_codeudores/croquis/')->with(compact('notification'));
  }
}

if($request->input('id_categoria_croquis')==3)
{
  $cro2 = Croquis::where('id_persona', Session::get('id_persona_codeudor'))->where('id_categoria_croquis',3)->count();
  if ($cro2 >=1){
    alert()->info('Info', 'Ya registro sus datos de croquis de actividad económica.')->showConfirmButton();
    return redirect('oficial/a_codeudores/croquis/');
  }else{
    $cro = new Croquis();
    $cro->latitud = $request->input('latitud');
    $cro->longitud = $request->input('longitud');
    $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
    $cro->id_persona =Session::get('id_persona_codeudor'); ;
    $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification = 'Exelente el croquis ha sido agregada correctamente';
    return redirect('oficial/a_codeudores/croquis/')->with(compact('notification'));
  }
}
if($request->input('id_categoria_croquis')==4)
{
  $cro2 = Croquis::where('id_persona', Session::get('id_persona_codeudor'))->where('id_categoria_croquis',4)->count();
  if ($cro2 >=1){
    alert()->info('Info', 'Ya registro sus datos de croquis de actividad económica.')->showConfirmButton();
    return redirect('oficial/a_codeudores/croquis/');
  }else{
    $cro = new Croquis();
    $cro->latitud = $request->input('latitud');
    $cro->longitud = $request->input('longitud');
    $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
    $cro->id_persona =Session::get('id_persona_codeudor');
    $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification = 'Exelente el croquis ha sido agregada correctamente';
    return redirect('oficial/a_codeudores/croquis/')->with(compact('notification'));
  }
}
}

public function see($id)
{    
  $latitud=Croquis::where('id_croquis',$id)->firstOrFail()->latitud;
  $longitud=Croquis::where('id_croquis',$id)->firstOrFail()->longitud;
  return view('oficial.a_codeudores.croquis.see')->with('latitud',$latitud)->with('longitud',$longitud);
}

public function edit($id)
{
  $croquis=Croquis::find($id);
  $categoria=CategoriaCroquis::All();
    return view('oficial.a_codeudores.croquis.edit')->with(compact('croquis','categoria')); //formulario de registro
  }
  public function update(Request $request,$id)
  {
    $cro=Croquis::find($id); 
    $cro->latitud = $request->input('latitud');
    $cro->longitud = $request->input('longitud');
    $cro->id_categoria_croquis = $request->input('id_categoria_croquis'); 
    $cro->save();
    $notification= 'Exelente sus datos se han modificado correctamente';     
    return redirect('oficial/a_codeudores/croquis/')->with(compact('notification'));
  }
}
