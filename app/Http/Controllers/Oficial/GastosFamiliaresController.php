<?php
namespace sis5cs\Http\Controllers\Oficial;

use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\GastosFamiliares;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\GastosFamiliaresFormRequest;

//variables

class GastosFamiliaresController extends Controller
{

    public $id_persona;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $gastos = GastosFamiliares::where('id_persona', Session::get('id_persona'))->get();
            //--------------Gastos familiares total
            $total_gastos = DB::table('gastos_familiares')
                ->select(DB::raw('sum(COALESCE(alimentacion,0)+COALESCE(energia_electrica,0)+COALESCE(agua,0)+COALESCE(telefono,0)+COALESCE(gas,0)+COALESCE(impuestos,0)+COALESCE(alquileres,0)+COALESCE(educacion,0)+COALESCE(transporte,0)+COALESCE(salud,0)+COALESCE(empleada,0)+COALESCE(diversion,0)+COALESCE(vestimenta,0)+COALESCE(otros,0))'))
                ->where('id_persona', Session::get('id_persona'))
                ->get();
            //--------------
            return view('oficial.gastos_familiares.index')->with(compact('gastos'))->with('total_gastos', $total_gastos[0]->sum);
        }

    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $if_exist = GastosFamiliares::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist > 0) {
                alert()->info('Info', 'Ya registro los datos de gastos familiares.')->showConfirmButton();
                return redirect('oficial/gastos_familiares/');
            } else {

                return view('oficial.gastos_familiares.create');
            }

        }

    }
    public function store(GastosFamiliaresFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $gastos = new GastosFamiliares();
        $gastos->alimentacion = $request->input('alimentacion');
        $gastos->energia_electrica = $request->input('energia_electrica');
        $gastos->agua = $request->input('agua');
        $gastos->telefono = $request->input('telefono');
        $gastos->gas = $request->input('gas');
        $gastos->impuestos = $request->input('impuestos');
        $gastos->alquileres = $request->input('alquileres');
        $gastos->educacion = $request->input('educacion');
        $gastos->transporte = $request->input('transporte');
        $gastos->salud = $request->input('salud');
        $gastos->empleada = $request->input('empleada');
        $gastos->diversion = $request->input('diversion');
        $gastos->vestimenta = $request->input('vestimenta');
        $gastos->otros = $request->input('otros');
        $gastos->detalle = $request->input('detalle');
        $gastos->id_persona = $this->id_persona;
        $gastos->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/gastos_familiares')->with(compact('notification'));
    }

    public function edit($id)
    {
        $gastos = GastosFamiliares::find($id);
        return view('oficial.gastos_familiares.edit')->with(compact('gastos')); //formulario de registro
    }
    public function update(GastosFamiliaresFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $gastos = GastosFamiliares::find($id);
        $gastos->alimentacion = $request->input('alimentacion');
        $gastos->energia_electrica = $request->input('energia_electrica');
        $gastos->agua = $request->input('agua');
        $gastos->telefono = $request->input('telefono');
        $gastos->gas = $request->input('gas');
        $gastos->impuestos = $request->input('impuestos');
        $gastos->alquileres = $request->input('alquileres');
        $gastos->educacion = $request->input('educacion');
        $gastos->transporte = $request->input('transporte');
        $gastos->salud = $request->input('salud');
        $gastos->empleada = $request->input('empleada');
        $gastos->diversion = $request->input('diversion');
        $gastos->vestimenta = $request->input('vestimenta');
        $gastos->otros = $request->input('otros');
        $gastos->detalle = $request->input('detalle');
        $gastos->id_persona = $this->id_persona;
        $gastos->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('/oficial/gastos_familiares')->with(compact('notification'));
    }

    /*-------------
public function destroy($id)
{

$cro=Croquis::find($id);
$cro->delete(); //delete
return back();
}--------------*/
}
