<?php

namespace sis5cs\Http\Controllers\Oficial;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Image;
use Session;
use sis5cs\CategoriaFoto;
use sis5cs\Foto;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\FotoFormRequest;

class FotoController extends Controller
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
        $fotos = DB::table('foto')
        ->join('categoria_foto', 'categoria_foto.id_categoria_foto', '=', 'foto.id_categoria_foto')
        ->select('foto.*', 'categoria_foto.categoria')
        ->where('id_persona', Session::get('id_persona'))
        ->get();
        return view('oficial.foto.index', compact('fotos'));
    }

    public function create()
    {
        $categorias = CategoriaFoto::All();
        return view('oficial.foto.create')->with(compact('categorias'));
    }

    public function store(FotoFormRequest $request)
    {
        $path = public_path() . '/images/fotos/';
        $imagenOriginal = $request->file('fotografia');
        $imagen = Image::make($imagenOriginal);
        $temp_name = uniqid() . '.' . $imagenOriginal->getClientOriginalExtension();
        $imagen->resize(800, 600);
        $imagen->save($path . $temp_name, 100);
        //variable temporal
        $foto = new Foto();
        $foto->archivo = $temp_name;
        $foto->id_persona = Session::get('id_persona');
        $foto->id_categoria_foto = $request->input('id_categoria_foto');
        $foto->save();
        $notification = 'Exelente sus datos se han creado correctamente';
        return redirect('oficial/foto/')->with(compact('notification'));
    }
    public function edit($id)
    {
        $foto = Foto::find($id);
        $categoria = CategoriaFoto::All();
        return view('oficial.foto.edit')->with(compact('categoria', 'foto'));
    }

    public function descarga($id)
    {
        $foto = Foto::find($id);
        $pathtoFile=public_path().'/images/fotos/'.$foto->archivo;
        return response()->download($pathtoFile);        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_categoria_foto' => 'required|numeric',
        ]);
        //variable temporal       
        if (Input::hasFile('fotografia')) {
            $path = public_path() . '/images/fotos/';
            $imagenOriginal = $request->file('fotografia');
            $imagen = Image::make($imagenOriginal);
            $temp_name = uniqid() . '.' . $imagenOriginal->getClientOriginalExtension();
            $imagen->resize(800, 600);

            $foto = Foto::findOrFail($id);
            $foto->id_categoria_foto = $request->get('id_categoria_foto');
            $anterior_file = $foto->archivo;
            $foto->archivo = $temp_name;
            $foto->update(); //metodo se encarga de ejecutar un insert sobre la tabla
            if ($foto->save()) {
            //mover nuevo archivo al directorio
                $imagen->save($path . $temp_name, 100);
            //eliminar archivo antiguo del directorio
                $direccion = public_path() . '/images/fotos/' . $anterior_file;
                $deleted = File::delete($direccion);
            }
            $foto = Foto::findOrFail($id);
            $foto->id_categoria_foto = $request->get('id_categoria_foto');
            $foto->update();
        }      

        $notification = 'Exelente sus datos se han modificado correctamente';
        return redirect('oficial/foto/')->with(compact('notification'));

    }

    public function destroy($id)
    {
      $foto=Foto::find($id); 
      $direccion=public_path().'/images/fotos/'.$foto->archivo;
      $deleted=File::delete($direccion);
      $foto->delete(); //delete
      $notification= 'Exelente la fotografía se elimino correctamente'; 
      return back()->with(compact('notification'));
}
}
