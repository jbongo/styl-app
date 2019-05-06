<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadValidator extends FormRequest
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
            'nom'=>'required',
            'prenom' => 'required',
            'telephone' => 'required|numeric|digits:10',
            'email'=>'required|string|email|max:255|unique:leads,id',
            'adresse' =>'string|max:255',
            'code_postal'=>'required|numeric|digits:5',
            'ville'=>'required|string|max:255',
        ];
    }
}
