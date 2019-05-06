<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffreAchatValidator extends FormRequest
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
            'acquereur_type'=>'required',
            'mandant_aqs_id'=>'numeric',
            'mandant_aqc_id'=>'numeric',
            'mandant_aqm_id'=>'numeric',
            'mandant_aqg_id'=>'numeric',
            'range_01'=>'required|numeric',
            'range_02'=>'required|numeric',
            'charge_commission'=>'required',
            'date_offre'=>'required|date|before:tomorrow',
            'duree_validite'=>'required|numeric',
        ];
    }
}
