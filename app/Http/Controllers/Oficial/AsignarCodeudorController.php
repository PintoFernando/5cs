<?php
namespace sis5cs\Http\Controllers\Oficial;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\Codeudor;
use sis5cs\Conyugue;
use sis5cs\Http\Controllers\Controller;

class AsignarCodeudorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }
        $conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if ($conyugue > 0) {
            $conyugue = Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
            $personas = DB::table('persona')
                ->join('profesion', 'persona.id_profesion', '=', 'profesion.id_profesion')
                ->join('nacionalidad', 'persona.id_nacionalidad', '=', 'nacionalidad.id_nacionalidad')
                ->join('estado_civil', 'persona.id_estado_civil', '=', 'estado_civil.id_estado_civil')
                ->join('extension_ci', 'persona.id_ext', '=', 'extension_ci.id_ext', 'left outer')
                ->select('persona.*', 'profesion.profesion', 'nacionalidad.nacionalidad', 'estado_civil.estado_civil', 'extension_ci.extension')
                ->where('persona.id_persona', $conyugue)
                ->get();
            return view('oficial.a_codeudores.asignar_codeudor.index')->with(compact('personas'));
        } else {
            return redirect('oficial/codeudor/');
        }
    }
    public function asignar($id)
    {
        $e_code = Codeudor::where('codeudor', $id)->count();
        if ($e_code > 0) {
            alert()->info('Info', 'Ya registro al conyuge como codeudor')->showConfirmButton();
            return redirect('oficial/a_codeudores/asignar_codeudor');
        }
        else{
            $codeudor = new Codeudor();
            $codeudor->codeudor = $id;
            $codeudor->id_persona = Session::get('id_persona');
            $codeudor->ordinal_codeudor = 1;
            $codeudor->save();
            $notification = 'Exelente codeudor  asignado correctamente';
            return redirect('oficial/a_codeudores/asignar_codeudor/')->with(compact('notification'));
        }
       
    }
}
