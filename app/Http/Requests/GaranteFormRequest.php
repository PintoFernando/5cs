<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaranteFormRequest extends FormRequest
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
            'id_persona'=>'numeric',
            'ordinal_garante'=>'numeric'
        ];
    }

    public function messages()
   {
    return [
        'id_persona.numeric' => 'El id: debe ser un número.',
        'ordinal_garante.unique' => 'El número de garante ya ha sido registrado.'
        
    ];

   }
}
