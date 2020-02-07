<?php
namespace sis5cs\Http\Controllers\Cliente;

use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

use sis5cs\Http\Requests\ActividadEconomicaFormRequest;
use sis5cs\ActividadEconomica;
use sis5cs\TipoContrato;
use sis5cs\Afp;
use sis5cs\Persona;
use DB;
use Alert;
use Auth;

class ActividadEconomicaController extends Controller
{
    //variables de clase
  public $id_persona;

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $this->id_persona = Auth::user()->id_persona;
    $datos = ActividadEconomica::where('id_persona', $this->id_persona)->firstOrFail();
    return view('cliente.actividad_economica.index')->with(compact('datos'));
     /*$id_persona=Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
     $per=Persona::where('id_persona',$id_persona)->first()->id_persona;
     $direccion=Direccion::where('id_persona',$per)->firstOrFail(); 
     $tipo_vivienda=TipoVivienda::where('id_tipo_vivienda',$direccion->id_tipo_vivienda)->first()->tipo_vivienda;
     return view('cliente.direccion.index')->with(compact('direccion'))->with('tipo_vivienda',$tipo_vivienda); */

  }
  public function mensaje()
  {
    return view('cliente.direccion.index');
  }

  public function create()
  {
    $tipo_contrato = TipoContrato::All();
    $afp = Afp::All();
      //corregir relacion uno a uno esta uno a muchos en: persona-direccion}
    $this->id_persona = Auth::user()->id_persona; //obtenemos el id del usuario actual del sistema 
       //dd($this->id_persona);
    $exist = Persona::where('id_persona', $this->id_persona)->count();
    if ($exist > 0) {
      $per = Persona::where('id_persona', $this->id_persona)->first()->id_persona;
      $dat = ActividadEconomica::where('id_persona', $per)->count();
      if ($dat > 0) {
        alert()->info('Info', 'Ya registro sus datos economicos.')->showConfirmButton();
        return redirect('cliente/actividad_economica/');
      } else {
        return view('cliente.actividad_economica.create')->with(compact('tipo_contrato', 'afp'));
      }
    } else {
      alert()->info('Info', 'Registre sus datos generales antes de llenar este formulario.')->showConfirmButton();
      return redirect('cliente/actividad_economica/mensaje');
    }
  }
  public function store(ActividadEconomicaFormRequest $request)
  {
      //obtenemos el id del usuario actual del sistema    
    $this->id_persona = Auth::user()->id_persona;
    $datos = new ActividadEconomica();
    $datos->ciudad_ae = $request->input('ciudad_ae');
    $datos->provincia_ae = $request->input('provincia_ae');
    $datos->zona_ae = $request->input('zona_ae');
    $datos->direccion_ae = $request->input('direccion_ae');
    $datos->telefono_ae = $request->input('telefono_ae');
    $datos->actividad_qrealiza = $request->input('actividad_qrealiza');
    $datos->nit_ae = $request->input('nit_ae');
    $datos->horario_trabajo_ae = $request->input('horario_trabajo_ae');
    $datos->dias_trabajo_ae = $request->input('dias_trabajo_ae');
    $datos->antiguedad_trabajo_ae = $request->input('antiguedad_trabajo_ae');
    $datos->id_persona = $this->id_persona;
    $datos->save(); //metodo se encarga de ejecutar un insert sobre la tabla

    alert()->success('Exelente', 'Los datos económicos se agregaron correctamente')->showConfirmButton();
    $notification = 'Exelente sus datos economicos se añadieron correctamente';
    return redirect('cliente/actividad_economica/')->with(compact('notification'));
  }
}
