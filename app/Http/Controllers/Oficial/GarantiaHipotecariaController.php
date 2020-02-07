<?php

namespace sis5cs\Http\Controllers\Oficial;

use Illuminate\Http\Request;
use Session;
use sis5cs\Credito;
use sis5cs\GarantiaHipotecaria;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\GarantiaHipotecariaFormRequest;

class GarantiaHipotecariaController extends Controller
{
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
            $credito = Credito::where('id_persona', Session::get('id_persona'))->count();
            if ($credito > 0) {
                $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
                $hipotecaria = GarantiaHipotecaria::where('id_credito', $id_credito)->get();
                return view('oficial.garantia_hipotecaria.index')->with(compact('hipotecaria'));
            } else {
                alert()->info('Info', 'Llene los datos de crédito primero')->showConfirmButton();
                return redirect('oficial/dashboard/');
            }

        }

    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $credito = Credito::where('id_persona', Session::get('id_persona'))->count();
            if ($credito > 0) {
                $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
                $hipotecaria = GarantiaHipotecaria::where('id_credito', $id_credito)->count();
                if ($hipotecaria > 0) {
                    alert()->info('Info', 'ya registro datos')->showConfirmButton();
                    return redirect('oficial/garantia_hipotecaria/');
                } else {
                    return view('oficial.garantia_hipotecaria.create');
                }
            } else {
                alert()->info('Info', 'Llene los datos de crédito primero')->showConfirmButton();
                return redirect('oficial/dashboard/');
            }

        }

    }

    public function store(GarantiaHipotecariaFormRequest $request)
    {
        $credito = Credito::where('id_persona', Session::get('id_persona'))->count();
        if ($this->verifica($credito)) {
            $id_credito = Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
            $garantia_e = GarantiaHipotecaria::where('id_credito', $id_credito)->count();
            if ($garantia_e > 0) {
                alert()->info('Info', 'Ya lleno los datos')->showConfirmButton();
                return redirect('oficial/dashboard/');
            } else {
                $garantia = new GarantiaHipotecaria();
                $garantia->nombre_ap_propietario = $request->input('nombre_ap_propietario');
                $garantia->vivi_tipo = $request->input('vivi_tipo');
                $garantia->vivi_ubicacion_bien = $request->input('vivi_ubicacion_bien');
                $garantia->vivi_libro_ddrr = $request->input('vivi_libro_ddrr');
                $garantia->vivi_matricula = $request->input('vivi_matricula');
                $garantia->vivi_partida = $request->input('vivi_partida');
                $garantia->vivi_designacion = $request->input('vivi_designacion');
                $garantia->vivi_superficie = $request->input('vivi_superficie');
                $garantia->vivi_linderos = $request->input('vivi_linderos');
                $garantia->vivi_valor_comercial = $request->input('vivi_valor_comercial');
                $garantia->vivi_valor_avaluo = $request->input('vivi_valor_avaluo');
                $garantia->vivi_empresa_valuadora = $request->input('vivi_empresa_valuadora');
                $garantia->vehi_tipo = $request->input('vehi_tipo');
                $garantia->vehi_marca = $request->input('vehi_marca');
                $garantia->vehi_modelo = $request->input('vehi_modelo');
                $garantia->vehi_rua = $request->input('vehi_rua');
                $garantia->vehi_placa = $request->input('vehi_placa');
                $garantia->vehi_clase = $request->input('vehi_clase');
                $garantia->vehi_subtipo = $request->input('vehi_subtipo');
                $garantia->vehi_num_motor = $request->input('vehi_num_motor');
                $garantia->vehi_chasis = $request->input('vehi_chasis');
                $garantia->vehi_procedencia = $request->input('vehi_procedencia');
                $garantia->vehi_cilindrada = $request->input('vehi_cilindrada');
                $garantia->vehi_num_poliza = $request->input('vehi_num_poliza');
                $garantia->vehi_color = $request->input('vehi_color');
                $garantia->vehi_valor_comercial = $request->input('vehi_valor_comercial');
                $garantia->vehi_valor_avaluo = $request->input('vehi_valor_avaluo');
                $garantia->vehi_empresa_valuadora = $request->input('vehi_empresa_valuadora');
                $garantia->depo_nombres_titular_dpf1 = $request->input('depo_nombres_titular_dpf1');
                $garantia->depo_nombres_titular_dpf2 = $request->input('depo_nombres_titular_dpf2');
                $garantia->depo_entidad_emisora = $request->input('depo_entidad_emisora');
                $garantia->depo_num_dpf = $request->input('depo_num_dpf');
                $garantia->depo_monto = $request->input('depo_monto');
                $garantia->depo_fecha_apertura = $request->input('depo_fecha_apertura');
                $garantia->depo_fecha_vencimiento = $request->input('depo_fecha_vencimiento');
                $garantia->id_credito = $id_credito;
                $garantia->save(); //metodo se encarga de ejecutar un insert sobre la tabla
                $notification = 'Exelente sus datos  se añadieron correctamente';
                return redirect('oficial/garantia_hipotecaria')->with(compact('notification'));
            }

        } else {
            alert()->info('Info', 'Seleccione registre crédito primero')->showConfirmButton();
            return redirect('oficial/dashboard/');
        }

    }

    public function edit($id)
    {
        $garantia = GarantiaHipotecaria::find($id);
        return view('oficial.garantia_hipotecaria.edit')->with(compact('garantia')); //formulario de registro
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre_ap_propietario' => 'string|nullable',
            'vivi_tipo' => 'string|nullable',
            'vivi_ubicacion' => 'string|nullable',
            'vivi_libro_ddrr' => 'string|nullable',
            'vivi_matricula' => 'string|nullable',
            'vivi_partida' => 'string|nullable',
            'vivi_valor_comercial' => 'numeric|nullable',
            'vivi_valor_avaluo' => 'numeric|nullable',
            'vivi_empresa_valuadora' => 'string|nullable',
            'vivi_superficie' => 'numeric|nullable',
            'vivi_linderos' => 'string|nullable',
            'vivi_designacion' => 'string|nullable',
            'vehi_tipo' => 'string|nullable',
            'vehi_marca' => 'string|nullable',
            'vehi_modelo' => 'string|nullable',
            'vehi_rua' => 'string|nullable',
            'vehi_placa' => 'string|nullable',
            'vehi_clase' => 'string|nullable',
            'vehi_subtipo' => 'string|nullable',
            'vehi_num_motor' => 'string|nullable',
            'vehi_chasis' => 'string|nullable',
            'vehi_procedencia' => 'string|nullable',
            'vehi_cilindrada' => 'string|nullable',
            'vehi_num_poliza' => 'string|nullable',
            'vehi_color' => 'string|nullable',
            'vehi_valor_comercial' => 'numeric|nullable',
            'vehi_valor_avaluo' => 'numeric|nullable',
            'vehi_empresa_valuadora' => 'string|nullable',
            'depo_nombres_titular_dpf1' => 'string|nullable',
            'depo_nombres_titular_dpf2' => 'string|nullable',
            'depo_entidad_emisora' => 'string|nullable',
            'depo_num_dpf' => 'string|nullable',
            'depo_monto' => 'numeric|nullable',
            'depo_fecha_apertura' => 'date|nullable',
            'depo_fecha_vencimiento' => 'date|nullable',
        ]);
        $garantia = GarantiaHipotecaria::find($id);
        $garantia->nombre_ap_propietario = $request->input('nombre_ap_propietario');
        $garantia->vivi_tipo = $request->input('vivi_tipo');
        $garantia->vivi_ubicacion_bien = $request->input('vivi_ubicacion_bien');
        $garantia->vivi_libro_ddrr = $request->input('vivi_libro_ddrr');
        $garantia->vivi_matricula = $request->input('vivi_matricula');
        $garantia->vivi_partida = $request->input('vivi_partida');
        $garantia->vivi_designacion = $request->input('vivi_designacion');
        $garantia->vivi_linderos = $request->input('vivi_linderos');
        $garantia->vivi_superficie = $request->input('vivi_superficie');
        $garantia->vivi_valor_comercial = $request->input('vivi_valor_comercial');
        $garantia->vivi_valor_avaluo = $request->input('vivi_valor_avaluo');
        $garantia->vivi_empresa_valuadora = $request->input('vivi_empresa_valuadora');
        $garantia->vehi_tipo = $request->input('vehi_tipo');
        $garantia->vehi_marca = $request->input('vehi_marca');
        $garantia->vehi_modelo = $request->input('vehi_modelo');
        $garantia->vehi_rua = $request->input('vehi_rua');
        $garantia->vehi_placa = $request->input('vehi_placa');
        $garantia->vehi_clase = $request->input('vehi_clase');
        $garantia->vehi_subtipo = $request->input('vehi_subtipo');
        $garantia->vehi_num_motor = $request->input('vehi_num_motor');
        $garantia->vehi_chasis = $request->input('vehi_chasis');
        $garantia->vehi_procedencia = $request->input('vehi_procedencia');
        $garantia->vehi_cilindrada = $request->input('vehi_cilindrada');
        $garantia->vehi_num_poliza = $request->input('vehi_num_poliza');
        $garantia->vehi_color = $request->input('vehi_color');
        $garantia->vehi_valor_comercial = $request->input('vehi_valor_comercial');
        $garantia->vehi_valor_avaluo = $request->input('vehi_valor_avaluo');
        $garantia->vehi_empresa_valuadora = $request->input('vehi_empresa_valuadora');
        $garantia->depo_nombres_titular_dpf1 = $request->input('depo_nombres_titular_dpf1');
        $garantia->depo_nombres_titular_dpf2 = $request->input('depo_nombres_titular_dpf2');
        $garantia->depo_entidad_emisora = $request->input('depo_entidad_emisora');
        $garantia->depo_num_dpf = $request->input('depo_num_dpf');
        $garantia->depo_monto = $request->input('depo_monto');
        $garantia->depo_fecha_apertura = $request->input('depo_fecha_apertura');
        $garantia->depo_fecha_vencimiento = $request->input('depo_fecha_vencimiento');
        $garantia->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        $notification = 'Exelente sus datos  se modificaron correctamente';
        return redirect('oficial/garantia_hipotecaria')->with(compact('notification'));
    }

    public function verifica($dato)
    {
        if ($dato > 0) {
            return true;
        } else {
            return false;
        }
    }
}
