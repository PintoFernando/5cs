<?php

namespace sis5cs\Http\Controllers;

use Alert;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\CategoriaCroquis;
use sis5cs\Croquis;
use sis5cs\Http\Requests\CroquisFormRequest;

class CroquisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $croquis = DB::table('croquis')
            ->join('categoria_croquis', 'croquis.id_categoria_croquis', '=', 'categoria_croquis.id_categoria_croquis')
            ->select('croquis.*', 'categoria_croquis.categoria')
            ->where('id_persona', Session::get('id_persona'))
            ->get();
        return view('croquis.index')->with(compact('croquis'));
    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $categoria = CategoriaCroquis::All();
            return view('croquis.create')->with(compact('categoria'));
        }

    }

    public function store(CroquisFormRequest $request)
    {
        if ($request->input('id_categoria_croquis') == 1) {
            $cro = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 1)->count();
            if ($cro >= 1) {
                alert()->info('Info', 'Ya registro sus datos de croquis dirección.')->showConfirmButton();
                return redirect('/croquis/');
            } else {

                $cro = new Croquis();
                $cro->latitud = $request->input('latitud');
                $cro->longitud = $request->input('longitud');
                $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
                $cro->id_persona = Session::get('id_persona');
                $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
                $notification = 'Exelente el croquis ha sido agregada correctamente';
                return redirect('/croquis/')->with(compact('notification'));
            }

        }

        if ($request->input('id_categoria_croquis') == 2) {
            $cro1 = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 2)->count();
            if ($cro1 >= 1) {
                alert()->info('Info', 'Ya registro sus datos de croquis de empresa de trabajo.')->showConfirmButton();
                return redirect('/croquis/');
            } else {

                $cro = new Croquis();
                $cro->latitud = $request->input('latitud');
                $cro->longitud = $request->input('longitud');
                $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
                $cro->id_persona = Session::get('id_persona');
                $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
                $notification = 'Exelente el croquis ha sido agregada correctamente';
                return redirect('/croquis/')->with(compact('notification'));
            }
        }

        if ($request->input('id_categoria_croquis') == 3) {
            $cro2 = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 3)->count();
            if ($cro2 >= 1) {
                alert()->info('Info', 'Ya registro sus datos de croquis de actividad económica.')->showConfirmButton();
                return redirect('/croquis/');
            } else {
                $cro = new Croquis();
                $cro->latitud = $request->input('latitud');
                $cro->longitud = $request->input('longitud');
                $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
                $cro->id_persona = Session::get('id_persona');
                $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
                $notification = 'Exelente el croquis ha sido agregada correctamente';
                return redirect('/croquis/')->with(compact('notification'));
            }
        }

        if ($request->input('id_categoria_croquis') == 4) {
            $cro2 = Croquis::where('id_persona', Session::get('id_persona'))->where('id_categoria_croquis', 4)->count();
            if ($cro2 >= 1) {
                alert()->info('Info', 'Ya registro sus datos de croquis Otros.')->showConfirmButton();
                return redirect('/croquis/');
            } else {
                $cro = new Croquis();
                $cro->latitud = $request->input('latitud');
                $cro->longitud = $request->input('longitud');
                $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
                $cro->id_persona = Session::get('id_persona');
                $cro->save(); //metodo se encarga de ejecutar un insert sobre la tabla
                $notification = 'Exelente el croquis ha sido agregada correctamente';
                return redirect('/croquis/')->with(compact('notification'));
            }
        }
    }

    public function see($id)
    {
        $latitud = Croquis::where('id_croquis', $id)->firstOrFail()->latitud;
        $longitud = Croquis::where('id_croquis', $id)->firstOrFail()->longitud;
        return view('croquis.see')->with('latitud', $latitud)->with('longitud', $longitud);
    }

    public function edit($id)
    {
        $croquis = Croquis::find($id);
        $categoria = CategoriaCroquis::All();
        return view('croquis.edit')->with(compact('croquis', 'categoria')); //formulario de registro
    }
    public function update(Request $request, $id)
    {
        $cro = Croquis::find($id);
        $cro->latitud = $request->input('latitud');
        $cro->longitud = $request->input('longitud');
        $cro->id_categoria_croquis = $request->input('id_categoria_croquis');
        $cro->save();
        $notification = 'Exelente sus datos se han modificado correctamente';
        return redirect('/croquis/')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $cro = Croquis::find($id);
        $cro->delete(); //delete
        $notification = 'Exelente se ha eliminado correctamente';
        return back()->with(compact('notification'));
    }
}
