<?php
namespace sis5cs\Http\Controllers\Oficial;

use Alert;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\Direccion;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\DireccionFormRequest;
use sis5cs\TipoVivienda;

class DireccionController extends Controller
{
    public $id_persona;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $this->id_persona = Session::get('id_persona');
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $dir = DB::table('direccion')
                ->join('tipo_vivienda', 'direccion.id_tipo_vivienda', '=', 'tipo_vivienda.id_tipo_vivienda')
                ->select('direccion.*', 'tipo_vivienda.tipo_vivienda')
                ->where('id_persona', $this->id_persona)
                ->get();
            return view('oficial.direccion.index')->with(compact('dir'));

        }

    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $if_exist = Direccion::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist > 0) {
                alert()->info('Info', 'Ya registro los datos de la direccion.')->showConfirmButton();
                return redirect('oficial/direccion/');
            } else {
                $tipo = TipoVivienda::all();
                return view('oficial.direccion.create')
                    ->with(compact('tipo'));

            }

        }

    }
    public function store(DireccionFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $dir = new Direccion();
        $dir->direc_numero = $request->input('direc_numero');
        $dir->ciudad = $request->input('ciudad');
        $dir->provincia = $request->input('provincia');
        $dir->localidad = $request->input('localidad');
        $dir->zona = $request->input('zona');
        $dir->barrio = $request->input('barrio');
        $dir->cll_principal = $request->input('cll_principal');
        $dir->cll_secundaria = $request->input('cll_secundaria');
        $dir->tiempo_residencia = $request->input('tiempo_residencia');
        $dir->id_persona = $this->id_persona;
        $dir->id_tipo_vivienda = $request->input('id_tipo_vivienda');
        $dir->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        return redirect('oficial/direccion');
    }

    public function edit($id)
    {
        $dir = Direccion::find($id);
        $tipo_casa = TipoVivienda::All();
        return view('oficial.direccion.edit')->with(compact('dir', 'tipo_casa')); //formulario de registro
    }
    public function update(DireccionFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $dir = Direccion::find($id);
        $dir->direc_numero = $request->input('direc_numero');
        $dir->ciudad = $request->input('ciudad');
        $dir->provincia = $request->input('provincia');
        $dir->localidad = $request->input('localidad');
        $dir->localidad = $request->input('localidad');
        $dir->zona = $request->input('zona');
        $dir->barrio = $request->input('barrio');
        $dir->cll_principal = $request->input('cll_principal');
        $dir->cll_secundaria = $request->input('cll_secundaria');
        $dir->tiempo_residencia = $request->input('tiempo_residencia');
        $dir->id_tipo_vivienda = $request->input('id_tipo_vivienda');
        $dir->id_persona = $this->id_persona;
        $dir->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        return redirect('oficial/direccion');
    }
    /*-------------
public function destroy($id)
{

$cro=Croquis::find($id);
$cro->delete(); //delete
return back();
}--------------*/

}
