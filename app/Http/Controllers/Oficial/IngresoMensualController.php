<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Excel;
use sis5cs\Http\Requests\IngresoMensualFormRequest;

use sis5cs\IngresoMensual;
class IngresoMensualController extends Controller
{
	//variables de clase
  public $id_persona;
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    if(Session::get('id_persona')==null)
    {
      alert()->info('Info','Seleccione un socio')->showConfirmButton();
      return redirect('oficial/dashboard/');
    }
    else{
      $ingreso=IngresoMensual::where('id_persona',Session::get('id_persona'))->get();
      return view('oficial.ingreso_mensual.index')->with(compact('ingreso'));
    }
   
  }

  public function import(Request $request)
  {
      //var request 
    $this->id_persona=Session::get('id_persona');  
    Excel::load($request->ingreso_mensual, function($reader){  
      $reader->ignoreEmpty();   
      $reader->takeRows(3);	
      $reader->calculate();
      $excel = $reader->get();
      // iteracción
      $reader->each(function($row) {        
        $ingre = new IngresoMensual;
        $ingre->mes = $row->mes;
        $ingre->anio = $row->anio;
        $ingre->prestatario = $row->prestatario;
        $ingre->conyugue = $row->conyugue;
        $ingre->otros = $row->otros;
        $ingre->codeudores = $row->codeudores;
        $ingre->total_ingreso = $row->total_ingreso;
        $ingre->descripcion = $row->descripcion;
        $ingre->id_persona = $this->id_persona;
        $ingre->save();
      });
    });
    alert()->info('Info','Los datos se cargaron correctamente.')->showConfirmButton();
    return redirect('oficial/ingreso_mensual/');
  } 

  public function create()
  { 
   if(Session::get('id_persona')==null)
   {
    alert()->info('Info','Seleccione un socio')->showConfirmButton();
    return redirect('oficial/dashboard/');
  }
  else{
    $if_exist=IngresoMensual::where('id_persona',Session::get('id_persona'))->count();
    if($if_exist>2)
    {
     alert()->info('Info','Ya registro los datos de ingreso mensual')->showConfirmButton();
     return redirect('oficial/ingreso_mensual/');
   }
   else
   {			
     return view('oficial.ingreso_mensual.create');
   } 
 }


}

public function edit($id)
{
  if(Session::get('id_persona')==null)
  {
    alert()->info('Info','Seleccione un socio')->showConfirmButton();
    return redirect('oficial/dashboard/');
  }
  else
  {
        $ingresos=IngresoMensual::find($id);
        return view('oficial.ingreso_mensual.edit')->with(compact('ingresos')); //formulario de registro
  }
}

    public function update(Request $request,$id)
    {

      $this->validate($request, [
            'mes' => 'string',
            'anio' => 'numeric',
            'prestatario' => 'numeric|nullable',
            'conyugue' => 'numeric|nullable',
            'otros' => 'numeric|nullable',
            'codeudores' => 'numeric|nullable'
        ]);
      $this->id_persona=Session::get('id_persona');
      $ingre=IngresoMensual::find($id); 
      $ingre->mes=$request->input('mes');
      $ingre->anio=$request->input('anio');
      $ingre->prestatario=$request->input('prestatario');    
      $ingre->conyugue=$request->input('conyugue');    
      $ingre->otros=$request->input('otros');    
      $ingre->codeudores=$request->input('codeudores');    
      $ingre->total_ingreso=$request->input('prestatario')+$request->input('conyugue')+$request->input('otros')+$request->input('codeudores');
      $ingre->descripcion=$request->input('descripcion');    
      $ingre->id_persona=$this->id_persona;
      $ingre->save(); //metodo se encarga de ejecutar un insert sobre la tabla
      return redirect('/oficial/ingreso_mensual/');
    }

    public function download()
    {
      $pathtoFile=public_path().'/plantillas_excel/ingresoMensual.xls';
      return response()->download($pathtoFile);
    }
  }
