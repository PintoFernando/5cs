<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\ConyugueFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use sis5cs\Conyugue;
use DB;
use sis5cs\Persona;
use sis5cs\Cliente;
use sis5cs\Profesion;
use sis5cs\EstadoCivil;
use sis5cs\Nacionalidad;
use Session;
use sis5cs\Extension;

class ConyugueGaranteController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $conyugue = Conyugue::where('id_persona', Session::get('id_persona_garante'))->firstOrFail()->conyugue;
    $persona = DB::table('persona')
      ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
      ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
      ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
      ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext','left outer')
      ->select('persona.*', 'profesion.profesion', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil','extension_ci.extension')
      ->where('id_persona', $conyugue)
      ->get();
    return view('oficial.a_garantes.conyugue.index')->with(compact('persona'));
  }
  public function create()
  {
    $id_persona_garante = Session::get('id_persona_garante');
    if ($id_persona_garante == null) {
      alert()->info('Info', 'Seleccione un Garante')->showConfirmButton();
      return redirect('oficial/garante/');
    } else {
      $if_exist_c = Conyugue::where('id_persona', $id_persona_garante)->count();
      if ($if_exist_c > 0) {
        alert()->info('Info', 'Ya registro los datos de conyugue.')->showConfirmButton();
        return redirect('oficial/a_garantes/conyugue/');
      } else {
        $profesiones = Profesion::All();
        $estados = EstadoCivil::All();
        $nacionalidades = Nacionalidad::All();
        $extensiones = Extension::All();
        return view('oficial.a_garantes.conyugue.create')->with(compact('profesiones', 'estados', 'nacionalidades','extensiones'));
      }
    }

  }
  public function store(ConyugueFormRequest $request)
  {
    $id_persona_garante = Session::get('id_persona_garante');
    $persona = new Persona();
    $persona->ci = $request->input('ci');
    $persona->id_ext= $request->input('id_ext');
    $persona->nombre = $request->input('nombre');
    $persona->ap_paterno = $request->input('ap_paterno');
    $persona->ap_materno = $request->input('ap_materno');
    $persona->ap_casada = $request->input('ap_casada');
    $persona->fec_nac = $request->input('fec_nac');
    $persona->lugar_nac = $request->input('lugar_nac');
    $persona->genero = $request->input('genero');
    $persona->celular = $request->input('celular');
    $persona->dependientes = $request->input('dependientes');
    $persona->id_profesion = $request->input('id_profesion');
    $persona->id_estado_civil = $request->input('id_estado_civil');
    $persona->id_nacionalidad = $request->input('id_nacionalidad');
    $persona->save();

    if ($persona->save() == true) {
      $conyugue = new Conyugue();
      $conyugue->conyugue = $persona->id_persona;
      $conyugue->id_persona = $id_persona_garante;
      $conyugue->save();
      $notification = 'Exelente conyugue creado correctamente';
      return redirect('oficial/a_garantes/conyugue/')->with(compact('notification'));
    }

  }

  public function edit($id)
  {
    $persona = Persona::find($id);
    $profesiones = Profesion::all();
    $nacionalidades = Nacionalidad::all();
    $estados = EstadoCivil::all();
    $extensiones=Extension::All();
    return view('oficial.a_garantes.conyugue.edit')->with(compact('persona', 'profesiones', 'nacionalidades', 'estados','extensiones')); //formulario de registro
  }

  public function update(Request $request, $id)
  {
      // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array

     $this->validate($request, [
            'ci' => 'string|max:20',
            'nombre' => 'string|max:50',
            'ap_paterno' => 'string|max:50|',
            'ap_materno' => 'string|max:50',
            'ap_casada' => 'string|max:50|nullable',
            'fec_nac' => 'date',
            'lugar_nac' => 'string|nullable'
        ]);

    $persona = Persona::find($id);
    $persona->ci = $request->input('ci');
    $persona->id_ext=$request->input('id_ext');
    $persona->nombre = $request->input('nombre');
    $persona->ap_paterno = $request->input('ap_paterno');
    $persona->ap_materno = $request->input('ap_materno');
    $persona->ap_casada = $request->input('ap_casada');
    $persona->fec_nac = $request->input('fec_nac');
    $persona->lugar_nac = $request->input('lugar_nac');
    $persona->genero = $request->input('genero');
    $persona->celular = $request->input('celular');
    $persona->dependientes = $request->input('dependientes');
    $persona->id_profesion = $request->input('id_profesion');
    $persona->id_estado_civil = $request->input('id_estado_civil');
    $persona->id_nacionalidad = $request->input('id_nacionalidad');
    $persona->update(); //metodo se encarga de ejecutar un insert sobre la tabla
    $notification = 'Exelente sus datos  se modificaron correctamente';
    return redirect('oficial/a_garantes/conyugue')->with(compact('notification'));
  }
}
