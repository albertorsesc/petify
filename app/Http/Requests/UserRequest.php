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
        $isRequired = ! request()->has('status') ? 'required' : null;
        return [
            'first_name' => ['max:50', $isRequired],
            'last_name' => ['max:50', $isRequired],
            'user_type_id' => ['exists:user_types,id', $isRequired],
            'email' => ['email', 'max:100', $isRequired, 'unique:users,email,' . $this->user['id']],
            'phone' => ['max:60'],
            'password' => [$this->getMethod() === 'POST' ? 'required' : null, 'min:6', 'confirmed']
        ];
    }
}
