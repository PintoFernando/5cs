<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentasDocumentosCobrarFormRequest extends FormRequest
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
        'nit'=>'string|nullable',
        'nombre_razon_zocial'=>'string|nullable',
        'concepto'=>'string|nullable',
        'saldo'=>'numeric',
        'id_persona'=>'numeric'
        ];
    }
}
