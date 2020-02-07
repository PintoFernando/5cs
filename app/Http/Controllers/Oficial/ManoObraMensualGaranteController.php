<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\ManoObraMensualFormRequest;
use sis5cs\ManoObraMensual;
use Session;
use Alert;
use DB;

class ManoObraMensualGaranteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
  	//calculo de promedio sueldo líquido sueldo de solicitante
    //$sueldo_promedio=DB::table('deposito_bancario')->where('id_persona', Session::get('id_persona'))->sum('saldo');
		if(Session::get('id_persona_garante')==null)
			{
				alert()->info('Info','Seleccione un garante')->showConfirmButton();
				return redirect('oficial/garante/');
			}
			else
			{
				$mano=ManoObraMensual::where('id_persona',Session::get('id_persona_garante'))->get();
				$total_mano_obra=DB::table('mano_obra_mensual')->where('id_persona', Session::get('id_persona_garante'))->sum('total_mano_obra');
				return view('oficial.a_garantes.mano_obra.index')->with(compact('mano'))->with('total_mano_obra',$total_mano_obra);

			}

		} 

		public function create()
		{ 
			if(Session::get('id_persona_garante')==null)
				{
					alert()->info('Info','Seleccione un socio')->showConfirmButton();
					return redirect('oficial/garante/');
				}
				else{
					$if_exist=ManoObraMensual::where('id_persona',Session::get('id_persona_garante'))->count();
					if($if_exist>100)
					{
						alert()->info('Info','Ya registro los datos de mano de obra.')->showConfirmButton();
						return redirect('oficial/a_garantes/mano_obra/');
					}
					else
					{			
						return view('oficial.a_garantes.mano_obra.create');
					} 
				}	
				
			}

			public function store(ManoObraMensualFormRequest $request)
			{
       // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
				$id_persona_garante=Session::get('id_persona_garante');
				$mano= new ManoObraMensual();      
				$mano->descripcion_cargo=$request->input('descripcion_cargo');
				$mano->num_personas=$request->input('num_personas');
				$mano->sueldo_mensual=$request->input('sueldo_mensual');
				$mano->total_mano_obra=$request->input('num_personas')
				*$request->input('sueldo_mensual');
				$mano->id_persona=$id_persona_garante;		
        $mano->save(); //metodo se encarga de ejecutar un insert sobre la tabla  
        $notification= 'Exelente sus datos se han agregado correctamente';     
        return redirect('oficial/a_garantes/mano_obra/')->with(compact('notification'));

    }


    public function edit($id)
    {
    	$mano=ManoObraMensual::find($id);
      return view('oficial.a_garantes.mano_obra.edit')->with(compact('mano')); //formulario de registro
  }
  public function update(ManoObraMensualFormRequest $request,$id)
  {
  	$this->id_persona_garante=Session::get('id_persona_garante');
  	$mano=ManoObraMensual::find($id); 
  	$mano->descripcion_cargo=$request->input('descripcion_cargo');
  	$mano->num_personas=$request->input('num_personas');
  	$mano->sueldo_mensual=$request->input('sueldo_mensual');
  	$mano->total_mano_obra=$request->input('num_personas')
  	*$request->input('sueldo_mensual');
  	$mano->id_persona=$this->id_persona_garante;		
 $mano->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 return redirect('oficial/a_garantes/mano_obra');
}
}
