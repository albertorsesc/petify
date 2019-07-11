<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => ['max:50', 'required'],
            'last_name' => ['max:50', 'required'],
            'user_type_id' => ['exists:user_types,id', 'required'],
            'email' => ['email', 'max:100', 'required', 'unique:users,email,'.$this->user['id']],
            'phone' => ['max:60'],
            'password' => [$this->getMethod() === 'POST' ? 'required' : null, 'min:6', 'confirmed'],
        ];
    }
}
