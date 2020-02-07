<?php

namespace sis5cs\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\Conyugue;
use sis5cs\EstadoCivil;
use sis5cs\Extension;
use sis5cs\Http\Requests\ConyugueFormRequest;
use sis5cs\Nacionalidad;
use sis5cs\Persona;
use sis5cs\Profesion;

class ConyugueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $econyuge=Conyugue::where('id_persona',Session::get('id_persona'))->count();
        if($econyuge>0)
        {
            $conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
            $persona = DB::table('persona')
                ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
                ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
                ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
                ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
                ->select('persona.*', 'profesion.profesion', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil', 'extension_ci.extension')
                ->where('persona.id_persona', $conyugue)
                ->get();
            return view('conyugue.index')->with(compact('persona'));
        }
        else{
            return redirect('/dashboard/');
        }
       
    }
    public function create()
    {
        $id_persona = Session::get('id_persona');
        if ($id_persona == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('/dashboard/');
        } else {
            $if_exist_c = Conyugue::where('id_persona', $id_persona)->count();
            if ($if_exist_c > 0) {
                alert()->info('Info', 'Ya registro los datos de conyugue.')->showConfirmButton();
                return redirect('/conyugue/');
            } else {
                $profesiones = Profesion::All();
                $estados = EstadoCivil::All();
                $nacionalidades = Nacionalidad::All();
                $extensiones = Extension::All();
                return view('conyugue.create')->with(compact('profesiones', 'estados', 'nacionalidades', 'extensiones'));
            }
        }
    }
    public function store(ConyugueFormRequest $request)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('/dashboard/');
        }
        $id_persona = Session::get('id_persona');
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
        $persona->save();

        if ($persona->save() == true) {
            $conyugue = new Conyugue();
            $conyugue->conyugue = $persona->id_persona;
            $conyugue->id_persona = $id_persona;
            $conyugue->save();
            $notification = 'Exelente conyugue creado correctamente';
            return redirect('/conyugue/')->with(compact('notification'));
        }

    }

    public function edit($id)
    {
        $persona = Persona::find($id);
        $profesion = Profesion::all();
        $nacionalidad = Nacionalidad::all();
        $estados = EstadoCivil::all();
        $extensiones = Extension::All();
        return view('conyugue.edit')->with(compact('persona', 'profesion', 'nacionalidad', 'estados', 'extensiones')); //formulario de registro
    }

    public function update(Request $request, $id)
    {
        // registrar el nuevo cliente
        // dd($request->all()); método dd muestra el contenido del array

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
        return redirect('/conyugue/')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->delete(); //delete
        $id_conyugue = Conyugue::where('conyugue', $id)->firstOrFail()->id_conyugue;
        $conyugue = Conyugue::find($id_conyugue);
        $conyugue->delete();
        $notification = 'Se ha eliminado correctamente';
        return back()->with(compact('notification'));
    }
}
