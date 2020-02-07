<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionFormRequest extends FormRequest
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
            
            'direc_numero'=>'string|nullable',
            'ciudad'=>'string',
            'provincia'=>'string|nullable',
            'localidad'=>'string|nullable',
            'zona'=>'string|nullable',
            'barrio'=>'string|nullable',
            'cll_principal'=>'string',
            'cll_secundaria'=>'string|nullable',
            'tiempo_residencia'=>'date',
            'id_persona'=>'numeric',
            'id_croquis'=>'numeric',
            'id_tipo_vivienda'=>'numeric'

        ];
          
   }
          
}
