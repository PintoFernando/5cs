<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest
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
            'ci'=>'required|string',
            'nombre'=>'required|max:256|string',
            'ap_paterno'=>'required|max:256|string',
            'ap_materno'=>'nullable|max:256|string',
            'ap_casada'=>'max:25|string|nullable',
            'fec_nac'=>'max:256|date|required',
            'genero'=>'max:256|string|required',
            'celular'=>'string',
            'dependientes'=>'numeric|required',
            'num_socio'=>'numeric|nullable',
            'estado_civil'=>'max:256|string',
            'id_profesion'=>'numeric'
            ];
    }

}
