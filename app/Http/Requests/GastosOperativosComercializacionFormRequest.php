<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosOperativosComercializacionFormRequest extends FormRequest
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
            /*
            'combustible'=>'numeric|required',
            'deposito_almacen'=>'numeric|required',
            'energia_electrica'=>'numeric|required',
            'agua'=>'numeric|required',
            'gas'=>'numeric|required',
            'telefono'=>'numeric|required',
            'impuestos'=>'numeric|required',
            'alquiler'=>'numeric|required',
            'cuidado_sereno'=>'numeric|required',
            'transporte'=>'numeric|required',
            'mantenimiento'=>'numeric|required',
            'publicidad'=>'numeric|required',
            'otros'=>'numeric|required'
            */
        ];
        

    }
}
