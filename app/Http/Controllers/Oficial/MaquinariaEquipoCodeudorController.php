<?php
namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\MaquinariaEquipoFormRequest;
use sis5cs\MaquinariaEquipo;

class MaquinariaEquipoCodeudorController extends Controller
{
    public $id_persona_codeudor;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un Codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $maquinaria = MaquinariaEquipo::where('id_persona', Session::get('id_persona_codeudor'))->get();
            return view('oficial.a_codeudores.maquinaria_equipo.index')->with(compact('maquinaria'));

        }
    }
    public function create()
    {
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $if_exist = MaquinariaEquipo::where('id_persona', Session::get('id_persona_codeudor'))->count();
            if ($if_exist > 100) {
                alert()->info('Info', 'Ya registro las datos de maquinaria equipo')->showConfirmButton();
                return redirect('oficial/a_codeudores/maquinaria_equipo/');
            } else {
                return view('oficial.a_codeudores.maquinaria_equipo.create');
            }

        }
    }

    public function store(MaquinariaEquipoFormRequest $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $ma = new MaquinariaEquipo();
        $ma->descripcion = $request->input('descripcion');
        $ma->marca = $request->input('marca');
        $ma->modelo = $request->input('modelo');
        $ma->anio = $request->input('anio');
        $ma->asegurado = $request->input('asegurado');
        $ma->aseguradora = $request->input('aseguradora');
        $ma->entidad_acreedora = $request->input('entidad_acreedora');
        $ma->total = $request->input('total');
        $ma->id_persona = $this->id_persona_codeudor;
        //$ma->id_tipo_vivienda=$request->input('id_tipo_vivienda');
        $ma->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/a_codeudores/maquinaria_equipo')->with(compact('notification'));
    }

    public function edit($id)
    {
        $maquinaria = MaquinariaEquipo::find($id);
        return view('oficial.a_codeudores.maquinaria_equipo.edit')->with(compact('maquinaria')); //formulario de registro
    }
    public function update(MaquinariaEquipoFormRequest $request, $id)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $maquinaria = MaquinariaEquipo::find($id);
        $maquinaria->descripcion = $request->input('descripcion');
        $maquinaria->marca = $request->input('marca');
        $maquinaria->modelo = $request->input('modelo');
        $maquinaria->anio = $request->input('anio');
        $maquinaria->asegurado = $request->input('asegurado');
        $maquinaria->aseguradora = $request->input('aseguradora');
        $maquinaria->entidad_acreedora = $request->input('entidad_acreedora');
        $maquinaria->total = $request->input('total');
        $maquinaria->id_persona = $this->id_persona_codeudor;
        $maquinaria->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('oficial/a_codeudores/maquinaria_equipo')->with(compact('notification'));
    }
}
