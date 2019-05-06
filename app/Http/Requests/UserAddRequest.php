<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
           'val-lastname' => 'required|string|max:255',
            'val-firstname' => 'required|string|max:255',
            'val-civilite' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'val-adress' => 'required|string|max:255',
            'val-compl_adress' => 'nullable|max:255',
            'val-zip' => 'required|numeric',
            'val-town' => 'required|string|max:255',
            'val-country' => 'required|string|max:255',
            'val-phone' => 'required|string|max:255',
            'val-select' => 'required|string|max:255',
        ];
    }
}
