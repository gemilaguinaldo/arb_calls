<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class CreateRequest extends Request
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
            'email'     => 'required|email|unique:users,email',
            'name'      => 'required',
            'role_id'   => 'required'
        ];
    }

    public function messages(){
        return [
            'email.required'    => __('system.required_fields.email'),
            'name.required'     => __('system.required_fields.name'),
            'role_id.required'  => __('system.required_fields.role'),
        ];
    }
}
