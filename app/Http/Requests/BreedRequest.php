<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreedRequest extends FormRequest
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
        $isRequired = ! request()->has('status') ||
                        ($this->getMethod() === 'POST' || $this->getMethod() === 'PUT') ?
                        'required' :
                        null;

        return [
            'specie_id' => [$isRequired, 'exists:species,id'],
            'name' => [$isRequired, 'max:100'],
        ];
    }
}
