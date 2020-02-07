<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaComercializacionProductoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'producto' => 'required|string',
            'cantidad' => 'required|numeric',
            'unidad_medida' => 'required|string',
            'v_costo_unitario' => 'required|numeric',
            'c_precio_unitario' => 'required|numeric'
            
        ];
    }
}
