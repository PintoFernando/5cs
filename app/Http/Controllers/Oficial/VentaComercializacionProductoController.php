<?php

namespace sis5cs\Http\Controllers\Oficial;

use Excel;
use Illuminate\Http\Request;
use Session;
use sis5cs\Http\Controllers\Controller;
use sis5cs\VentaComercializacionProducto;

class VentaComercializacionProductoController extends Controller
{
    // variables
    public $numero_filas;
    public $id_persona;

    public function index()
    {
        $this->id_persona = Session::get('id_persona');
        if ($this->id_persona == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $venta = VentaComercializacionProducto::where('id_persona', $this->id_persona)->get();
            return view('oficial.venta_comercializacion_producto.index')->with(compact('venta'));
        }

    }

    public function import(Request $request)
    {
        //var request
        $this->numero_filas = $request->num_rows;
        $this->id_persona = Session::get('id_persona');
        // dd('Numero de filas'.$this->numero_filas.'id persona:'.$this->id_persona);
        Excel::selectSheets('calculo')->load($request->costo_ventas, function ($reader) {
            $reader->ignoreEmpty();
            $reader->takeRows($this->numero_filas);
            $reader->calculate();
            $excel = $reader->get();
            // iteracción
            $reader->each(function ($row) {
                $venta = new VentaComercializacionProducto;
                $venta->producto = $row->producto;
                $venta->cantidad = $row->cantidad;
                $venta->unidad_medida = $row->unidad_medida;
                $venta->c_costo_unitario = $row->c_costo_unitario;
                $venta->c_costo_total = $row->c_costo_total;
                $venta->v_precio_unitario = $row->v_precio_unitario;
                $venta->v_precio_total = $row->v_precio_total;
                $venta->utilidad = $row->utilidad;
                $venta->porcentaje = $row->porcentaje;
                $venta->detalle = $row->detalle;
                $venta->id_persona = $this->id_persona;
                $venta->save();
            });
        });
        alert()->info('Info', 'Los datos se cargaron correctamente.')->showConfirmButton();
        return redirect('oficial/venta_comercializacion_producto/');
    }

    public function create()
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $if_exist = VentaComercializacionProducto::where('id_persona', Session::get('id_persona'))->count();
            if ($if_exist > 100) {
                alert()->info('Info', 'Ya registro los datos de venta y comercializacion.')->showConfirmButton();
                return redirect('oficial/venta_comercializacion_producto/');
            } else {
                return view('oficial.venta_comercializacion_producto.create');
            }
        }

    }

    public function edit($id)
    {
        if (Session::get('id_persona') == null) {
            alert()->info('Info', 'Seleccione un socio')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $ventas = VentaComercializacionProducto::find($id);

            return view('oficial.venta_comercializacion_producto.edit')->with(compact('ventas')); //formulario de registro
        }
    }

    public function update(VentaComercializacionProductoFormRequest $request, $id)
    {
        $ven = VentaComercializacionProducto::find($id);
        $ven->producto = $request->input('producto');
        $ven->cantidad = $request->input('cantidad');
        $ven->unidad_medida = $request->input('unidad_medida');
        $ven->v_costo_unitario = $request->input('v_costo_unitario');
        $ven->v_costo_total = $request->input('v_costo_total');
        $ven->c_precio_unitario = $request->input('c_precio_unitario');
        $ven->c_precio_total = $request->input('c_precio_total');
        $ven->utilidad = $request->input('utilidad');
        $ven->porcentaje = $request->input('porcentaje');
        $ven->detalle = $request->input('detalle');
        $ven->id_persona = $this->id_persona;
        $ven->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        return redirect('/oficial/venta_comercializacion_producto/');
    }

    public function destroy($id)
    {

        $venta = VentaComercializacionProducto::find($id);
        $venta->delete(); //delete
        return back();
    }

    public function download()
    {
        $pathtoFile = public_path() . '/plantillas_excel/venta_comercializacion.xls';
        return response()->download($pathtoFile);
    }

    public function download_transporte()
    {
        $pathtoFile = public_path() . '/plantillas_excel/venta_transporte.xls';
        return response()->download($pathtoFile);
    }
    public function download_comercio()
    {
        $pathtoFile = public_path() . '/plantillas_excel/comercio.xls';
        return response()->download($pathtoFile);
    }
}
