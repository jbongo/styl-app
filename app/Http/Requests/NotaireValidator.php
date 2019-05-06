<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaireValidator extends FormRequest
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
            'nom'=>'required|unique:notaires,id,:id|max:255',
            'email'=>'required|email|unique:notaires,id,:id',
            'telephone'=>'required|numeric|unique:notaires,id,:id',
            'adresse'=>'required|max:255',
            'code_postal'=>'required|numeric',
        ];
    }
}
