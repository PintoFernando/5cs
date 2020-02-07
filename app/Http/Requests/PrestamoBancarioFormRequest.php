<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoBancarioFormRequest extends FormRequest
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
             'importe_original'=>'numeric|nullable',
             'duracion_credito'=>'numeric|nullable',
             'importe_ultimo_pago'=>'numeric|required',
             'destino_credito'=>'string|nullable',
             'saldo'=>'required|numeric',
             'id_entidad_bancaria'=>'required|numeric',
             'id_tcredito'=>'required|numeric'
        ];
    }
}
