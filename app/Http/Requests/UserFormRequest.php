<?php

namespace sis5cs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name' => 'string|required',
                        'email' => 'email|required|unique:users',
                        'password' => 'string|required',
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'name' => 'string',
                        'email' => 'email',
                        'password' => 'string',
                    ];
                }
            default:break;
        }
    }
}
