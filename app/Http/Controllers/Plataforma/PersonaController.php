<?php

namespace sis5cs\Http\Controllers\Plataforma;

use DB;
use Illuminate\Http\Request;
use sis5cs\EstadoCivil;
use sis5cs\Extension;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\PersonaFormRequest;
use sis5cs\Nacionalidad;
use sis5cs\Persona;
use sis5cs\Profesion;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'plataforma']);
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
        return view('plataforma.persona.crud.index')->with(compact('personas'));
    }
    public function create()
    {
        $profesiones = Profesion::All();
        $nacionalidades = Nacionalidad::All();
        $estados = EstadoCivil::All();
        $extensiones = Extension::All();
        return view('plataforma.persona.crud.create')->with(compact('profesiones', 'nacionalidades', 'estados', 'extensiones')); //listado

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
        return redirect('/plataforma/persona/crud')->with(compact('notification'));
    }

    public function edit($id)
    {
        $persona = Persona::find($id);
        $nacionalidad = Nacionalidad::All();
        $profesion = Profesion::All();
        $estados = EstadoCivil::All();
        $extensiones = Extension::All();
        return view('plataforma.persona.crud.edit')->with(compact('persona', 'profesion', 'estados', 'nacionalidad', 'extensiones')); //formulario de registro
    }
    public function update(PersonaFormRequest $request, $id)
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
            'num_socio' => 'numeric|nullable',
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
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('/plataforma/persona/crud')->with(compact('notification'));
    }

    public function reporte(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $personas = DB::table('persona')
                ->where('nombre', 'ILIKE', '%' . $query . '%')
                ->orwhere('ci', 'ILIKE', '%' . $query . '%')
                ->orderBy('id_persona', 'desc')
                ->paginate(7);
            return view('persona.crud.reporte', ["personas" => $personas, "searchText" => $query]);
        }
        //busqueda por nombre y ci
        /*$clientes=Cliente::paginate(7);
    return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }

    public function word($id)
    {
        $persona = Persona::find($id);
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('C:\project\sis5cs\public\plantillas\acta_comite_credito.docx');

// --- Asignamos valores a la plantilla
        //fechas

        setlocale(LC_ALL, "Spanish_Bolivia");
        $fecha = strftime("%A %d de %B del %Y");
        $hora = strftime("%H :%M :%S ");
        $nombre = $persona->nombre . ' ' . $persona->ap_paterno . ' ' . $persona->ap_materno;
        $nombres = $persona->nombre . '_' . $persona->ap_paterno . '_' . $persona->ap_materno;
        $templateWord->setValue('nombre', $nombre);
        $templateWord->setValue('hora', $hora);
        $templateWord->setValue('fecha', $fecha);
        $templateWord->setValue('ci', $persona->ci);

// --- Guardamos el documento
        $templateWord->saveAs('Documento02.docx');

        header("Content-Disposition: attachment; filename=actacomite_$nombres.docx; charset=iso-8859-1");
        echo file_get_contents('Documento02.docx');

    }
}
