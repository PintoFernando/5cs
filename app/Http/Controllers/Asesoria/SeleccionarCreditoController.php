<?php
namespace sis5cs\Http\Controllers\Asesoria;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Persona;

class SeleccionarCreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $creditos = DB::table('credito')
            ->join('persona', 'credito.id_persona', '=', 'persona.id_persona')
            ->join('tipo_credito', 'credito.id_tcredito', '=', 'tipo_credito.id_tcredito')
            ->select('credito.*', 'persona.*','tipo_credito.tipo_credito')
            ->get();
        return view('asesoria.seleccionar_credito.index')->with(compact('creditos'));
    }

    public function seleccionar_credito($id_persona,$id_credito)
    {
        $datos_persona=Persona::where('id_persona',$id_persona)->firstOrFail();
        Session::put('id_credito',$id_credito);
        Session::put('id_persona',$id_persona);
        Session::put('id_persona_oficial',$datos_persona->nombre.' '.$datos_persona->ap_paterno.' '.$datos_persona->ap_materno);
        alert()->info('Info','Exelente')->showConfirmButton();
        return view('asesoria.dashboard.index');
    }
}
