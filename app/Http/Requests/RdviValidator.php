<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RdviValidator extends FormRequest
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
            'adresse'=>'required',
            'code_postal'=>'required|numeric|digits:5',
            'ville'=>'required',
            'date_rdv'=>'required|date|after:today',
            'heure_rdv'=>'required',
        ];
    }
}
