<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapacidadPagoFormRequest extends FormRequest
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

           'porcentaje'=>'numeric|required',
           'amortizacion_coop_san_martin'=>'numeric|required'
        ];
    }
}
