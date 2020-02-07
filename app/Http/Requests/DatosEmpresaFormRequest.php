<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatosEmpresaFormRequest extends FormRequest
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
            'nombre_empresa'=>'string',
            'actividad_empresa'=>'string',
            'antiguedad_empresa'=>'date',
            'ciudad_empresa'=>'string',
            'provincia_empresa'=>'string',
            'zona_empresa'=>'string',
            'direccion_empresa'=>'string',
            'telefono_empresa'=>'string|nullable',
            'cargo_en_empresa'=>'string',
            'antiguedad_en_cargo'=>'date',
            'sueldo_promedio'=>'numeric',
            'horario_trabajo'=>'string',
            'dias_trabajo'=>'string',
            'id_persona'=>'numeric',
            'id_afp'=>'numeric',
            'id_tc'=>'numeric'
        ];
    }
}
