<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferenciaSolicitanteFormRequest extends FormRequest
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
            'ap_paterno'=>'required|string',
            'ap_materno'=>'nullable|string',
            'nombre'=>'required',
            'parentesco'=>'required',
            'celular'=>'nullable|numeric',
            'telefono'=>'nullable|numeric'
        ];
    }
}
