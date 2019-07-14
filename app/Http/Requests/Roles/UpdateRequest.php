<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class UpdateRequest extends Request
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
            'name'          => "required|unique:roles,name,{$this->route('role')},id,deleted_at,NULL",
            'description'   => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'         => __('system.required_fields.name'),
            'description.required'  => __('system.required_fields.description')
        ];
    }
}