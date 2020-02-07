<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadEconomicaFormRequest extends FormRequest
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
        'ciudad_ae'=>'string',
        'provincia_ae'=>'string',
        'zona_ae'=>'string|nullable',
        'direccion_ae'=>'string',
        'telefono_ae'=>'string|nullable',
        'actividad_qrealiza'=>'string',
        'nit_ae'=>'string|nullable',
        'horario_trabajo_ae'=>'string',
        'dias_trabajo_ae'=>'string',
        'antiguedad_trabajo_ae'=>'date',
        'id_persona'=>'numeric'
        
        ];
    }
}
