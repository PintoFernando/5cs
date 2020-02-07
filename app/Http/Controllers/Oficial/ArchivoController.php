<?php
namespace sis5cs\Http\Controllers\Oficial;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Image;
use Session;
use sis5cs\CategoriaArchivo;
use sis5cs\Archivo;
use sis5cs\Http\Controllers\Controller;
use Carbon\Carbon;

class ArchivoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		if (Session::get('id_persona') == null) {
			alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
			return redirect('oficial/dashboard/');
		}
		$archivos = DB::table('archivo')
		->join('categoria_archivo', 'categoria_archivo.id_categoria_archivo', '=', 'archivo.id_categoria_archivo')
		->select('archivo.*', 'categoria_archivo.categoria')
		->where('id_persona', Session::get('id_persona'))
		->get();
		return view('oficial.archivo.index', compact('archivos'));
	}

	public function create()
	{
		$categorias = CategoriaArchivo::All();
		return view('oficial.archivo.create')->with(compact('categorias'));
	}

	public function store(Request $request)
	{
		if($request->hasFile('archivo'))
		{
			$archivo = $request->file('archivo');
			$nombre= uniqid().$archivo->getClientOriginalName();
			$path = public_path().'/archivos/';
			

			$archi = new Archivo();
			$archi->id_persona=Session::get('id_persona');
			$archi->archivo=$nombre;
			$archi->id_categoria_archivo=$request->input('id_categoria_archivo');
			$archi->save();	
			if($archi->save())
			{
				$archivo->move($path,$nombre);
				$notification = 'Exelente se ha guardado el archivo correctamente';
				return redirect('oficial/archivo/')->with(compact('notification'));
			}		

			
		}
		else
		{
			$notification = 'Debe cargar un archivo';
			return redirect('oficial/archivo/')->with(compact('notification'));
		}

		
	}
	public function edit($id)
	{
		$archivos = Archivo::find($id);
		$categoria = CategoriaArchivo::All();
		return view('oficial.archivo.edit')->with(compact('categoria', 'archivos'));
	}

	public function descarga($id)
	{
		$archivo = Archivo::find($id);
		$pathtoFile=public_path().'/archivos/'.$archivo->archivo;
		return response()->download($pathtoFile);        
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_categoria_archivo' => 'required|numeric',
		]);
        //variable temporal       
		if (Input::hasFile('archivo')){
			$archivo = $request->file('archivo');
			$nombre= uniqid().$archivo->getClientOriginalName();
			$path = public_path().'/archivos/';

			$archi = Archivo::findOrFail($id);
			$archi->id_categoria_archivo = $request->get('id_categoria_archivo');
			$archi->id_persona = Session::get('id_persona');
			$anterior_file = $archi->archivo;
			$archi->archivo = $nombre;
			$archi->update();
             //metodo se encarga de ejecutar un insert sobre la tabla
			if ($archi->update()) {
            //mover nuevo archivo al directorio
				$archivo->move($path,$nombre);
            //eliminar archivo antiguo del directorio
				$direccion = public_path() . '/archivos/' . $anterior_file;
				$deleted = File::delete($direccion);
				
				$notification = 'Exelente sus datos se han modificado correctamente';
				return redirect('oficial/archivo/')->with(compact('notification'));
			}

		} 
		else{
			$notification = 'Intente cargar el archivo denuevo';
			return redirect('oficial/foto/')->with(compact('notification'));
		}     



	}

	public function destroy($id)
	{
		$archivo=Archivo::find($id); 
		$direccion=public_path().'/archivos/'.$archivo->archivo;
		$deleted=File::delete($direccion);
      $archivo->delete(); //delete
      $notification= 'Exelente la fotografía se elimino correctamente'; 
      return back()->with(compact('notification'));
  }
}
