<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use sis5cs\ActividadEconomica;
use sis5cs\Http\Requests\ActividadEconomicaFormRequest;

class ActividadEconomicaGaranteController extends Controller
{
    public $id_persona_garante;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Session::get('id_persona_garante') == null) {
            alert()->info('Info', 'Seleccione un garante')->showConfirmButton();
            return redirect('oficial/garante/');
        } else {
            $actividad = ActividadEconomica::where('id_persona', Session::get('id_persona_garante'))->get();
            return view('oficial.a_garantes.actividad_economica.index')->with(compact('actividad'));
        }

    }
    public function create()
    {
        if (Session::get('id_persona_garante') == null) {
            alert()->info('Info', 'Seleccione un garante')->showConfirmButton();
            return redirect('oficial/garante/');
        } else {
            $if_exist = ActividadEconomica::where('id_persona', Session::get('id_persona_garante'))->count();
            if ($if_exist > 0) {
                alert()->info('Info', 'Ya registro los datos de Actividad Económica.')->showConfirmButton();
                return redirect('oficial/a_garantes/actividad_economica/');
            } else {

                return view('oficial.a_garantes.actividad_economica.create');
            }

        }

    }
    public function store(ActividadEconomicaFormRequest $request)
    {
        $this->id_persona_garante = Session::get('id_persona_garante');
        $actividad = new ActividadEconomica();
        $actividad->ciudad_ae = $request->input('ciudad_ae');
        $actividad->provincia_ae = $request->input('provincia_ae');
        $actividad->zona_ae = $request->input('zona_ae');
        $actividad->direccion_ae = $request->input('direccion_ae');
        $actividad->telefono_ae = $request->input('telefono_ae');
        $actividad->actividad_qrealiza = $request->input('actividad_qrealiza');
        $actividad->nit_ae = $request->input('nit_ae');
        $actividad->horario_trabajo_ae = $request->input('horario_trabajo_ae');
        $actividad->dias_trabajo_ae = $request->input('dias_trabajo_ae');
        $actividad->antiguedad_trabajo_ae = $request->input('antiguedad_trabajo_ae');
        $actividad->id_persona = $this->id_persona_garante;
        $actividad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos se han modificado correctamente';
        return redirect('oficial/a_garantes/actividad_economica')->with(compact('notification'));
    }

    public function edit($id)
    {
        $actividad = ActividadEconomica::find($id);
        return view('oficial.a_garantes.actividad_economica.edit')->with(compact('actividad')); //formulario de registro
    }
    public function update(ActividadEconomicaFormRequest $request, $id)
    {
        $this->id_persona_garante = Session::get('id_persona_garante');
        $actividad = ActividadEconomica::find($id);
        $actividad->ciudad_ae = $request->input('ciudad_ae');
        $actividad->provincia_ae = $request->input('provincia_ae');
        $actividad->zona_ae = $request->input('zona_ae');
        $actividad->direccion_ae = $request->input('direccion_ae');
        $actividad->telefono_ae = $request->input('telefono_ae');
        $actividad->actividad_qrealiza = $request->input('actividad_qrealiza');
        $actividad->nit_ae = $request->input('nit_ae');
        $actividad->horario_trabajo_ae = $request->input('horario_trabajo_ae');
        $actividad->dias_trabajo_ae = $request->input('dias_trabajo_ae');
        $actividad->antiguedad_trabajo_ae = $request->input('antiguedad_trabajo_ae');
        $actividad->id_persona = $this->id_persona_garante;
        $actividad->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos se han modificado correctamente';
        return redirect('oficial/a_garantes/actividad_economica/')->with(compact('notification'));

    }
}
