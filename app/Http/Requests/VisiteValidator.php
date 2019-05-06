<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisiteValidator extends FormRequest
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
            'nom_visiteur'=>'required',
            'adresse'=>'required',
            'code_postal'=>'required|numeric|digits:5',
            'ville'=>'required',
            'date_visite'=>'required|date|before:today',
            'commentaire'=>'required',
        ];
    }
}
