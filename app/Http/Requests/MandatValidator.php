<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MandatValidator extends FormRequest
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
            'bien_id'=>'unique:mandats,id,:id|numeric',
            'mandant_id' => 'numeric',
            'groupemandant_id' => 'numeric',
            'numero'=>'required|numeric|unique:mandats,id,:id',
            'type' =>'required',
            'date_debut'=>'required|date|before:tomorrow',
            'date_fin'=>'required|date|after:tomorrow|after:date_debut',
        ];
    }
}
