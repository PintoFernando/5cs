<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\EfectivoCajaFormRequest;
use sis5cs\EfectivoCaja;
use sis5cs\Persona;
use Session;

class EfectivoCajaController extends Controller
{
 public $id_persona;
 public function __construct()
 {
  $this->middleware('auth');
}
public function index(Request $request)
{
  if(Session::get('id_persona')==null)
    {
     alert()->info('Info','Seleccione un Socio')->showConfirmButton();
     return redirect('oficial/dashboard/');
   }
   else
   {
    $efectivo=EfectivoCaja::where('id_persona',Session::get('id_persona'))->get();
    return view('oficial.efectivos_caja.index')->with(compact('efectivo'));
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

     $if_exist=EfectivoCaja::where('id_persona',Session::get('id_persona'))->count();
     if($if_exist>0)
     {
       alert()->info('Info','Ya registro las datos de efectivos en caja')->showConfirmButton();
       return redirect('oficial/efectivos_caja/');
     }
     else
     {      
       return view('oficial.efectivos_caja.create');
     } 

   }
 }
 public function store(EfectivoCajaFormRequest $request)
 {
   $this->id_persona=Session::get('id_persona');  
   $efectivo = new EfectivoCaja(); 
   $efectivo->caja=$request->input('caja');
   $efectivo->id_persona=$this->id_persona;
 $efectivo->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente los datos se han guardado correctamente'; 
 return redirect('oficial/efectivos_caja')->with(compact('notification'));
}

public function edit($id)
{
 $efe=EfectivoCaja::find($id);
      return view('oficial.efectivos_caja.edit')->with(compact('efe')); //formulario de registro
    }
    public function update(EfectivoCajaFormRequest $request,$id)
    {
     $this->id_persona=Session::get('id_persona');
     $efe=EfectivoCaja::find($id); 
     $efe->caja=$request->input('caja');
     $efe->id_persona=$this->id_persona;
     $efe->save(); //metodo se encarga de ejecutar un insert sobre la tabla
     $notification= 'Exelente sus datos se han modificado correctamente';     
     return redirect('oficial/efectivos_caja/')->with(compact('notification'));

   }
 }

