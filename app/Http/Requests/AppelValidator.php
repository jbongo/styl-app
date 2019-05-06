<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppelValidator extends FormRequest
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
            'source'=>'required',
            'nom_appelant'=>'required',
            'code_postal'=>'required|numeric|digits:5',
            'date_appel'=>'required|date|before:today',
            'commentaires'=>'required',
        ];
    }
}
