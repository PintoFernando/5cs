<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaquinariaEquipoFormRequest extends FormRequest
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
            'descripcion'=>'string|nullable',
            'marca'=>'string|nullable',
            'modelo'=>'string|nullable',
            'anio'=>'numeric|nullable',
            'asegurado'=>'string|nullable',
            'aseguradora'=>'string|nullable',
            'entidad_acreedora'=>'string|nullable',
            'total'=>'numeric',
            'id_persona'=>'numeric'
        ];
    }
}
