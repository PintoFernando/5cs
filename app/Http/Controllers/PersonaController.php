<?php
namespace sis5cs\Http\Controllers;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use sis5cs\Persona;
use sis5cs\Profesion;
use sis5cs\Nacionalidad;
use sis5cs\EstadoCivil;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;
use sis5cs\Extension;
use Yajra\DataTables\DataTables;

class PersonaController extends Controller
{  
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(Request $request)
  {
      $personas = DB::table('persona')
          ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
          ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
          ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
          ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext')
          ->select('persona.*', 'nacionalidad.nacionalidad', 'profesion.profesion', 'estado_civil.estado_civil', 'extension_ci.extension')
          ->get();
      return view('persona.index')->with(compact('personas'));
  }
  public function create()
  {
      $profesiones = Profesion::All();
      $nacionalidades = Nacionalidad::All();
      $estados = EstadoCivil::All();
      $extensiones = Extension::All();
      return view('persona.create')->with(compact('profesiones', 'nacionalidades', 'estados', 'extensiones'));
  }

  public function store(PersonaFormRequest $request)
  {
      $persona = new Persona();
      $persona->ci = $request->input('ci');
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
      $persona->num_socio = $request->input('num_socio');
      $persona->id_profesion = $request->input('id_profesion');
      $persona->id_ext = $request->input('id_ext');
      $persona->id_estado_civil = $request->input('id_estado_civil');
      $persona->id_nacionalidad = $request->input('id_nacionalidad');
      $persona->save(); //metodo se encarga de ejecutar un insert sobre la tabla

      $notification = 'Exelente sus datos  se añadieron correctamente';
      return redirect('/persona')->with(compact('notification'));
  }

  public function edit($id)
  {
      $persona = Persona::find($id);
      $nacionalidad = Nacionalidad::All();
      $profesion = Profesion::All();
      $estados = EstadoCivil::All();
      $extensiones = Extension::All();
      return view('persona.edit')->with(compact('persona', 'profesion', 'estados', 'nacionalidad', 'extensiones')); //formulario de registro
  }
  public function update(Request $request, $id)
  {
      $this->validate($request, [
          'ci' => 'string|max:20|required',
          'nombre' => 'string|required',
          'ap_paterno' => 'string|required',
          'ap_materno' => 'string|nullable',
          'ap_casada' => 'string|nullable',
          'fec_nac' => 'date|required',
          'lugar_nac' => 'string|nullable',
          'departamento_nac' => 'string|nullable',
          'ciudad_nac' => 'string|nullable',
          'provincia_nac' => 'string|nullable',
          'genero' => 'string|required',
          'celular' => 'string|required',
          'dependientes' => 'numeric|required',
          'num_socio' => 'numeric|nullable'
      ]);
      $persona = Persona::find($id);
      $persona->ci = $request->input('ci');
      $persona->nombre = $request->input('nombre');
      $persona->ap_paterno = $request->input('ap_paterno');
      $persona->ap_materno = $request->input('ap_materno');
      $persona->ap_casada = $request->input('ap_casada');
      $persona->fec_nac = $request->input('fec_nac');
      $persona->lugar_nac = $request->input('lugar_nac');
      $persona->departamento_nac = $request->input('departamento_nac');
      $persona->ciudad_nac = $request->input('ciudad_nac');
      $persona->provincia_nac = $request->input('provincia_nac');
      $persona->num_socio = $request->input('num_socio');
      $persona->genero = $request->input('genero');
      $persona->celular = $request->input('celular');
      $persona->dependientes = $request->input('dependientes');
      $persona->id_profesion = $request->input('id_profesion');
      $persona->id_ext = $request->input('id_ext');
      $persona->id_estado_civil = $request->input('id_estado_civil');
      $persona->id_nacionalidad = $request->input('id_nacionalidad');
      $persona->save(); //metodo se encarga de ejecutar un insert sobre la tabla
      $notification = 'Exelente sus datos  se modificaron correctamente';
      return redirect('persona')->with(compact('notification'));
  }
public function destroy($id)
{
 $persona= Persona::findOrFail($id);
 Persona::destroy($id);
 return back();
}

}
