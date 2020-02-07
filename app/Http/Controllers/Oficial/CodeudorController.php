<?php

namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\CodeudorFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use sis5cs\Codeudor;
use DB;
use sis5cs\Persona;
use sis5cs\Cliente;
use Session;
use sis5cs\EstadoCivil;
use sis5cs\Profesion;
use sis5cs\Nacionalidad;
use sis5cs\Extension;

class CodeudorController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
   $id_persona =Session::get('id_persona');
   $persona = DB::table('persona')
   ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
   ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
   ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
   ->join('codeudor', 'persona.id_persona', '=', 'codeudor.codeudor')
   ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext')
   ->select('persona.*', 'profesion.profesion', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil','codeudor.ordinal_codeudor', 'extension_ci.extension')
   ->where('codeudor.id_persona', $id_persona)
   ->get();
   return view('oficial.codeudor.index')->with(compact('persona'));
 }
 public function create()
 {
  $id_persona = Session::get('id_persona');
  if ($id_persona == null) {
    alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
    return redirect('oficial/dashboard/');
  } else {
    $if_exist_c = Codeudor::where('id_persona', $id_persona)->count();
    if ($if_exist_c > 2) {
      alert()->info('Info', 'Ya registro los datos de codeudor.')->showConfirmButton();
      return redirect('oficial/codeudor/');
    } else {
      $profesiones = Profesion::All();
      $estados = EstadoCivil::All();
      $nacionalidades = Nacionalidad::All();
      $extensiones=Extension::All();
      return view('oficial.codeudor.create')->with(compact('profesiones', 'estados', 'nacionalidades','extensiones'));
    }
  }

}
public function store(CodeudorFormRequest $request)
{
  $id_persona = Session::get('id_persona');
  $persona = new Persona();
  $persona->ci = $request->input('ci');
  $persona->id_ext = $request->input('id_ext');
  $persona->num_socio = $request->input('num_socio');
  $persona->nombre = $request->input('nombre');
  $persona->ap_paterno = $request->input('ap_paterno');
  $persona->ap_materno = $request->input('ap_materno');
  $persona->ap_casada = $request->input('ap_casada');
  $persona->fec_nac = $request->input('fec_nac');
  $persona->departamento_nac = $request->input('departamento_nac');
  $persona->ciudad_nac = $request->input('ciudad_nac');
  $persona->provincia_nac = $request->input('provincia_nac');
  $persona->genero = $request->input('genero');
  $persona->celular = $request->input('celular');
  $persona->dependientes = $request->input('dependientes');
  $persona->id_profesion = $request->input('id_profesion');
  $persona->id_estado_civil = $request->input('id_estado_civil');
  $persona->id_nacionalidad = $request->input('id_nacionalidad');
  $persona->save();

  if ($persona->save() == true) {
    $codeudor = new Codeudor();
    $codeudor->codeudor = $persona->id_persona;
    $codeudor->id_persona = $id_persona;
    $codeudor->ordinal_codeudor = $request->input('ordinal_codeudor');
    $codeudor->save();
    $notification = 'Exelente codeudor  creado correctamente';
    return redirect('oficial/codeudor/')->with(compact('notification'));
  }

}

public function edit($id)
{
  $persona = Persona::find($id);
  $profesion = Profesion::all();
  $nacionalidad = Nacionalidad::all();
  $estados = EstadoCivil::all();
  $extensiones=Extension::All();
  $codeudor=Codeudor::where('codeudor',$id)->get();
    return view('oficial.codeudor.edit')->with(compact('persona', 'profesion', 'nacionalidad', 'estados','extensiones','codeudor')); //formulario de registro
  }

  public function update(Request $request, $id)
  {
      // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
    $this->validate($request, [
      'ci' => 'string|max:20',
      'id_ext' => 'numeric',
      'nombre' => 'string',
      'ap_paterno' => 'string',
      'ap_materno' => 'string',
      'ap_casada' => 'string|nullable',
      'fec_nac' => 'date',
      'lugar_nac' => 'string',
      'genero' => 'string',
      'celular' => 'numeric',
      'dependientes' => 'numeric'
    ]);

    $persona = Persona::find($id);
    $persona->ci = $request->input('ci');
    $persona->id_ext = $request->input('id_ext');
    $persona->num_socio = $request->input('num_socio');
    $persona->nombre = $request->input('nombre');
    $persona->ap_paterno = $request->input('ap_paterno');
    $persona->ap_materno = $request->input('ap_materno');
    $persona->ap_casada = $request->input('ap_casada');
    $persona->fec_nac = $request->input('fec_nac');
    $persona->lugar_nac = $request->input('lugar_nac');
    $persona->departamento_nac = $request->input('departamento_nac');
    $persona->ciudad_nac = $request->input('ciudad_nac');
    $persona->provincia_nac = $request->input('provincia_nac');
    $persona->genero = $request->input('genero');
    $persona->celular = $request->input('celular');
    $persona->dependientes = $request->input('dependientes');
    $persona->id_profesion = $request->input('id_profesion');
    $persona->id_estado_civil = $request->input('id_estado_civil');
    $persona->id_nacionalidad = $request->input('id_nacionalidad');
    $persona->save(); //metodo se encarga de ejecutar un insert sobre la tabla

    $id_codeudor = Codeudor::where('codeudor',$id)->firstOrFail()->id_codeudor;
    $ordinal = Codeudor::find($id_codeudor);
    $ordinal->ordinal_codeudor =$request->input('ordinal_codeudor');
    $ordinal->save();

    $notification = 'Exelente sus datos  se modificaron correctamente';
    return redirect('oficial/codeudor')->with(compact('notification'));
  }
}
