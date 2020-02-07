<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

use sis5cs\Http\Requests\GarantiaFormRequest;

use sis5cs\Garantia;
use sis5cs\TipoGarantia;
use sis5cs\Credito;
use Session;
use DB;

class GarantiaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if(Session::get('id_persona')==null)
			{
				alert()->info('Info','Seleccione un socio')->showConfirmButton();
				return redirect('oficial/dashboard/');
			}
			else
			{
				$garantia = DB::table('garantia')
				->join('tipo_garantia', 'garantia.id_tipo_garantia', '=', 'tipo_garantia.id_tipo_garantia')
				->join('credito', 'garantia.id_credito', '=', 'credito.id_credito')
				->select('garantia.*', 'credito.*', 'tipo_garantia.*')
				->where('id_persona',Session::get('id_persona'))
				->get();
				return view('oficial.garantias.index')->with(compact('garantia'));

			}
		} 

		public function create()
		{ 
			if(Session::get('id_persona')==null)
				{
					alert()->info('Info','Seleccione un socio')->showConfirmButton();
					return redirect('oficial/dashboard/');
				}
				else{
					$if_exist_c=Credito::where('id_persona',Session::get('id_persona'))->count();
					if($if_exist_c==0)
					{
						alert()->info('Info','Registre los datos de crédito primero.')->showConfirmButton();
						return redirect('oficial/dashboard/');
					}
					$id_credito=Credito::where('id_persona',Session::get('id_persona'))->firstOrFail()->id_credito;
					$if_exist=Garantia::where('id_credito',$id_credito)->count();
					if($if_exist>=10)
					{
						alert()->info('Info','Ya registro los datos de garantia.')->showConfirmButton();
						return redirect('oficial/garantias/');
					}
					else
					{		
						$tipo_garantia=TipoGarantia::All();
						return view('oficial.garantias.create')->with(compact('tipo_garantia'));
					} 
				}	

			}

			public function store(GarantiaFormRequest $request)
			{


				$id_credito=Credito::where('id_persona',Session::get('id_persona'))->firstOrFail()->id_credito;
				$id_persona=Session::get('id_persona');
				$gara= new Garantia();      
				$gara->id_credito=$id_credito;
				$gara->id_tipo_garantia=$request->input('id_tipo_garantia');
        $gara->save(); //metodo se encarga de ejecutar un insert sobre la tabla  
    
        $notification= 'Exelente sus datos se han agregado correctamente';     
        return redirect('oficial/garantias/')->with(compact('notification'));


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
    			$garantia=Garantia::find($id);
    			$tipo_garantia=TipoGarantia::All();
      return view('oficial.garantias.edit')->with(compact('garantia','tipo_garantia')); //formulario de registro
  }

}
public function update(GarantiaFormRequest $request,$id)
{

	if(Session::get('id_persona')==null)
		{
			alert()->info('Info','Seleccione un socio')->showConfirmButton();
			return redirect('oficial/dashboard/');
		}
		else
		{
			$garantia=Garantia::find($id); 
			$garantia->id_tipo_garantia=$request->input('id_tipo_garantia');
            $garantia->save(); //metodo se encarga de ejecutar un insert sobre la tabla

        $notification= 'Exelente los datos se han modificado correctamente';
        return redirect('/oficial/garantias')->with(compact('notification'));
    }




}

}
