<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\CapacidadPagoFormRequest;
use sis5cs\CapacidadPago;
use sis5cs\TipoCredito;
use Session;

class CapacidadPagoCodeudorController extends Controller
{
    public $id_persona_codeudor;
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		if(Session::get('id_persona_codeudor')==null)
		{
			alert()->info('Info','Seleccione un codeudor')->showConfirmButton();
			return redirect('oficial/codeudor/');
		}
		else
		{
			$capacidad=CapacidadPago::where('id_persona',Session::get('id_persona_codeudor'))->get();
			return view('oficial.a_codeudores.capacidad_pago.index')->with(compact('capacidad'));
		}

	}
	public function create()
	{    
		if(Session::get('id_persona_codeudor')==null)
		{
			alert()->info('Info','Seleccione un codeudor')->showConfirmButton();
			return redirect('oficial/a_codeudores/dashboard/');
		}
		else
		{
			$if_exist=CapacidadPago::where('id_persona',Session::get('id_persona_codeudor'))->count();
			if($if_exist>0)
			{
				alert()->info('Info','Ya registro los datos de capacidad de pago.')->showConfirmButton();
				return redirect('oficial/a_codeudores/capacidad_pago/');
			}
			else
			{
				$tipo_credito=TipoCredito::all();
				return view('oficial.a_codeudores.capacidad_pago.create')->with(compact('tipo_credito'));
			}


		}

	}
	public function store(CapacidadPagoFormRequest $request)
	{
		$this->id_persona_codeudor=Session::get('id_persona_codeudor');  
		$capacidad = new CapacidadPago(); 
		$capacidad->porcentaje=$request->input('porcentaje');
		$capacidad->amortizacion_coop_san_martin=$request->input('amortizacion_coop_san_martin');
		$capacidad->id_persona=$this->id_persona_codeudor;
        $capacidad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification= 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/a_codeudores/capacidad_pago')->with(compact('notification'));
    }

    public function edit($id)
    {
    	if(Session::get('id_persona_codeudor')==null)
    	{
    		alert()->info('Info','Seleccione un codeudor')->showConfirmButton();
    		return redirect('oficial/codeudor/');
    	}
    	else
    	{
    		$capacidad=CapacidadPago::find($id);
      return view('oficial.a_codeudores.capacidad_pago.edit')->with(compact('capacidad')); //formulario de registro
  }

}
public function update(CapacidadPagoFormRequest $request,$id)
{
	$this->id_persona_codeudor=Session::get('id_persona_codeudor');
	$capacidad=CapacidadPago::find($id); 
	$capacidad->porcentaje=$request->input('porcentaje');
	$capacidad->amortizacion_coop_san_martin=$request->input('amortizacion_coop_san_martin');
	$capacidad->id_persona=$this->id_persona_codeudor;
    $capacidad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification= 'Exelente los datos se han modificado correctamente';
    return redirect('/oficial/a_codeudores/capacidad_pago')->with(compact('notification'));

}

    /*-------------
    public function destroy($id)
    {

     $cro=Croquis::find($id); 
      $cro->delete(); //delete
      return back();
  }--------------*/
}
