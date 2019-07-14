<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use Hash;

class ChangePasswordRequest extends Request
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
            'current_password'      => 'required',
            'new_password'          => 'required|same:confirm_password',
            'confirm_password'      => 'required'
        ];
    }

    public function messages(){
        return [
            'current_password.required'    => __('system.required_fields.current_password'),
            'new_password.required'     => __('system.required_fields.new_password'),
            'confirm_password.required'  => __('system.required_fields.confirm_password'),
        ];
    }
}
