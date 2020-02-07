<?php

namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\VehiculoFormRequest;
use sis5cs\Vehiculo;

class VehiculoCodeudorController extends Controller
{
    public $id_persona_codeudor;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un Codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $vehiculos = Vehiculo::where('id_persona', Session::get('id_persona_codeudor'))->get();
            return view('oficial.a_codeudores.vehiculo.index')->with(compact('vehiculos'));

        }

    }

    public function create()
    {
        if (Session::get('id_persona_codeudor') == null) {
            alert()->info('Info', 'Seleccione un codeudor')->showConfirmButton();
            return redirect('oficial/codeudor/');
        } else {
            $vehiculos = Vehiculo::all();
            return view('oficial.a_codeudores.vehiculo.create')
                ->with(compact('vehiculos'));
        }}
    public function store(VehiculoFormRequest $request)
    {
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $vehi = new Vehiculo();
        $vehi->tipo = $request->input('tipo');
        $vehi->marca = $request->input('marca');
        $vehi->modelo = $request->input('modelo');
        $vehi->placa = $request->input('placa');
        $vehi->rua = $request->input('rua');
        $vehi->en_garantia = $request->input('en_garantia');
        $vehi->valor = $request->input('valor');
        $vehi->id_persona = $this->id_persona_codeudor;
        $vehi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han guardado correctamente';
        return redirect('/oficial/a_codeudores/vehiculo')->with(compact('notification'));
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);
        return view('oficial.a_codeudores.vehiculo.edit')->with(compact('vehiculo')); //formulario de registro
    }
    public function update(VehiculoFormRequest $request, $id)
    {
        // registrar el nuevo cliente
        // dd($request->all()); método dd muestra el contenido del array
        $this->id_persona_codeudor = Session::get('id_persona_codeudor');
        $vehi = Vehiculo::find($id);
        $vehi->tipo = $request->input('tipo');
        $vehi->marca = $request->input('marca');
        $vehi->modelo = $request->input('modelo');
        $vehi->placa = $request->input('placa');
        $vehi->rua = $request->input('rua');
        $vehi->en_garantia = $request->input('en_garantia');
        $vehi->valor = $request->input('valor');
        $vehi->id_persona = $this->id_persona_codeudor;
        $vehi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente los datos se han modificado correctamente';
        return redirect('/oficial/a_codeudores/vehiculo')->with(compact('notification'));
    }
    /*public function destroy($id)
{
$vehi=Vehiculo::find($id);
$vehi->delete(); //delete
alert() -> error ( ' Oops ... ' , '¡ Algo salió mal! ' );
$notification= 'El vehículo ha sido eliminado correctamente';
return back()->with(compact('notification'));
}*/
}
