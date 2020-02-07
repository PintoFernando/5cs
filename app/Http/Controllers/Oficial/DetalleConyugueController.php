<?php
namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use Session;
use sis5cs\Conyugue;
use sis5cs\DetallePersona;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\DetalleConyugueFormRequest;

class DetalleConyugueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $id = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
        $detalle = DetallePersona::where('id_persona', $id)->get();
        return view('oficial.detalle_conyugue.index')->with(compact('detalle'));

    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $id = Conyugue::where('id_persona', Session::get('id_persona'))->count();
            if ($id > 0) {
                $conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
                if (Detallepersona::where('id_persona', $conyugue)->count() >= 1) {
                    alert()->info('Info', 'Ya registro detalle conyugue')->showConfirmButton();
                    return redirect('oficial/detalle_conyugue/');
                } else {
                    return view('oficial.detalle_conyugue.create');
                }
            } else {
                alert()->info('Info', 'Registre Conyugue Primero')->showConfirmButton();
                return redirect('oficial/conyugue/create');
            }

        }
    }

    public function store(DetalleConyugueFormRequest $request)
    {
        //id_conyugue
        $id_conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail();
        $detalle = new DetallePersona();
        $detalle->ocupacion = $request->input('ocupacion');
        $detalle->cargo = $request->input('cargo');
        $detalle->tiempo_trabajo = $request->input('tiempo_trabajo');
        $detalle->nombre_institucion = $request->input('nombre_institucion');
        $detalle->calle_principal = $request->input('calle_principal');
        $detalle->calle_secundaria = $request->input('calle_secundaria');
        $detalle->telefono = $request->input('telefono');
        $detalle->id_persona = $id_conyugue->conyugue;
        $detalle->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos se han guardado correctamente';
        return redirect('oficial/detalle_conyugue/')->with(compact('notification'));

    }
    public function edit($id)
    {
        $detalle = DetallePersona::find($id);
        return view('oficial.detalle_conyugue.edit')->with(compact('detalle')); //formulario de registro
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ocupacion' => 'string|nullable',
            'cargo' => 'string|nullable',
            'tiempo_trabajo' => 'date|nullable',
            'nombre_institucion' => 'string|nullable',
            'calle_principal' => 'string|nullable',
            'calle_secundaria' => 'string|nullable',
            'telefono' => 'string|nullable',
        ]);
        $detalle = DetallePersona::find($id);
        $detalle->ocupacion = $request->input('ocupacion');
        $detalle->cargo = $request->input('cargo');
        $detalle->tiempo_trabajo = $request->input('tiempo_trabajo');
        $detalle->nombre_institucion = $request->input('nombre_institucion');
        $detalle->calle_principal = $request->input('calle_principal');
        $detalle->calle_secundaria = $request->input('calle_secundaria');
        $detalle->telefono = $request->input('telefono');
        $detalle->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos se ha modificado los datos';
        return redirect('oficial/detalle_conyugue/')->with(compact('notification'));
    }
}
