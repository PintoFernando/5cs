<?php

namespace sis5cs\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class BienesHogarFormRequest extends FormRequest
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
           
            'articulo'=>'string|nullable',
            'descripcion'=>'string|nullable',
            'marca'=>'string|nullable',
            'color'=>'string|nullable',
            'modelo'=>'string|nullable',
            'estado'=>'string|nullable',
            'valor'=>'numeric',
            'id_persona'=>'numeric'
            ];
    }
}
