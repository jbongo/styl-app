<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuiviRecrutementValidator extends FormRequest
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
            'lead_id'=>'required|numeric',
            'date'=>'required|date|after:today',
            'heure'=>'required',
            'commentaires'=>'required',
        ];
    }
}
