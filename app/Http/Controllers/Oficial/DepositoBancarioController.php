<?php
namespace sis5cs\Http\Controllers\Oficial;

use Alert;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\DepositoBancario;
use sis5cs\EntidadBancaria;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\DepositoBancarioFormRequest;
use sis5cs\TipoDeposito;

class DepositoBancarioController extends Controller
{
    public $id_persona;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $this->id_persona = Session::get('id_persona');
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un Socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $deposito = DB::table('deposito_bancario')
                ->join('entidad_bancaria', 'deposito_bancario.id_entidad_bancaria', '=', 'entidad_bancaria.id_entidad_bancaria')
                ->join('tipo_deposito', 'deposito_bancario.id_tipo_deposito', '=', 'tipo_deposito.id_tipo_deposito')
                ->select('deposito_bancario.*', 'entidad_bancaria.nombre_entidad', 'tipo_deposito.nombre_deposito')
                ->where('id_persona', $this->id_persona)
                ->get();
            return view('oficial.deposito_bancario.index')->with(compact('deposito'));
        }

    }
    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $if_exist = DepositoBancario::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist >= 100) {
                alert()->info('Info', 'Ya registro Deposito Bancario.')->showConfirmButton();
                return redirect('oficial/deposito_bancario/');
            } else {
                $entidad = EntidadBancaria::all();
                $tipo = TipoDeposito::all();
                return view('oficial.deposito_bancario.create')
                    ->with(compact('entidad', 'tipo'));
            }

        }

    }

    public function store(DepositoBancarioFormRequest $request)
    {
        $this->id_persona = Session::get('id_persona');
        $dep = new DepositoBancario();
        $dep->numero_cuenta = $request->input('numero_cuenta');
        $dep->detalle = $request->input('detalle');
        $dep->saldo = $request->input('saldo');
        $dep->id_entidad_bancaria = $request->input('id_entidad_bancaria');
        $dep->id_tipo_deposito = $request->input('id_tipo_deposito');
        $dep->id_persona = $this->id_persona;
        $dep->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('oficial/deposito_bancario')->with(compact('notification'));
    }

    public function edit($id)
    {
        $dep = DepositoBancario::find($id);
        $entidad = EntidadBancaria::All();
        $tipo = TipoDeposito::All();
        return view('oficial.deposito_bancario.edit')->with(compact('dep', 'tipo', 'entidad')); //formulario de registro
    }

    public function update(DepositoBancarioFormRequest $request, $id)
    {
        $this->id_persona = Session::get('id_persona');
        $dep = DepositoBancario::find($id);
        $dep->numero_cuenta = $request->input('numero_cuenta');
        $dep->detalle = $request->input('detalle');
        $dep->saldo = $request->input('saldo');
        $dep->id_entidad_bancaria = $request->input('id_entidad_bancaria');
        $dep->id_tipo_deposito = $request->input('id_tipo_deposito');
        $dep->id_persona = $this->id_persona;
        $dep->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('oficial/deposito_bancario')->with(compact('notification'));
    }
    /*-------------
public function destroy($id)
{

$cro=Croquis::find($id);
$cro->delete(); //delete
return back();
}--------------*/

}
