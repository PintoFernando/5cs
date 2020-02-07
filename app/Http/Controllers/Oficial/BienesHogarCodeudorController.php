<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\BienesHogar;
use sis5cs\Persona;
use sis5cs\Http\Requests\BienesHogarFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use Session;
class BienesHogarCodeudorController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		if(Session::get('id_persona_codeudor')==null)
			{
				alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
				return redirect('oficial/codeudor/');
			}
			else
			{
				$bienes =BienesHogar::where('id_persona',Session::get('id_persona_codeudor'))->get();
				return view('oficial.a_codeudores.bienes_hogar.index')->with(compact('bienes'));
			}
		}
		public function create()
		{
			if(Session::get('id_persona_codeudor')==null)
				{
					alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
					return redirect('oficial/codeudor/');
				}
				else
				{           
					return view('oficial.a_codeudores.bienes_hogar.create');
				}       
			}
			public function store(BienesHogarFormRequest $request)
			{

				$bi = new BienesHogar();
				$bi->articulo = $request->input('articulo');
				$bi->descripcion = $request->input('descripcion');
				$bi->marca = $request->input('marca');
				$bi->color = $request->input('color');
				$bi->modelo = $request->input('modelo');
				$bi->estado = $request->input('estado');
				$bi->valor = $request->input('valor');
				$bi->id_persona = Session::get('id_persona_codeudor');
        $bi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification= 'Exelente sus datos se han guardado correctamente';     
        return redirect('oficial/a_codeudores/bienes_hogar/')->with(compact('notification'));
        
    }

    public function edit($id)
    {
    	$bienes = BienesHogar::find($id);
        return view('oficial.a_codeudores.bienes_hogar.edit')->with(compact('bienes')); //formulario de registro
    }
    public function update(BienesHogarFormRequest $request, $id)
    { 
    	$bi = BienesHogar::find($id);
    	$bi->articulo = $request->input('articulo');
    	$bi->descripcion = $request->input('descripcion');
    	$bi->marca = $request->input('marca');
    	$bi->color = $request->input('color');
    	$bi->modelo = $request->input('modelo');
    	$bi->estado = $request->input('estado');
    	$bi->valor = $request->input('valor');
        $bi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification= 'Exelente sus datos se ha modificado los datos';
        return redirect('oficial/a_codeudores/bienes_hogar/')->with(compact('notification'));
    }
}
