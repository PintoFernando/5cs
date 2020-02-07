<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeguimientoFormRequest extends FormRequest
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
        'id_seguimiento'=>'nullable',
        'fecha_inicio'=>'nullable',
        'fecha_fin'=>'nullable',
        'estado'=>'nullable',
        'usuario'=>'nullable',
        'id_persona'=>'numeric',
        'id_area'=>'numeric'       
        ];
    }
}
