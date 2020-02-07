<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleConyugueFormRequest extends FormRequest
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
            'ocupacion'=>'nullable|string',
            'cargo'=>'nullable|string',
            'tiempo_trabajo'=>'nullable|date',
            'nombre_institucion'=>'nullable|string',
            'calle_principal'=>'nullable|string',
            'calle_secundaria'=>'nullable|string',
            'telefono'=>'nullable|string'
            
        ];
    }
}
