<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class infosComplementaireRequest extends FormRequest
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
            'situation_matri' => 'required|string|max:100',
            'nom_jeune_fille' => 'string|nullable|max:255',
            'date_naissance' => 'required|date',
            'ville_naissance' => 'required|string|max:255',
            'pays_naissance' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'nom_pere' => 'required|string|max:255',
            'nom_mere' => 'required|string|max:255',
            'comment_connu_styli' => 'required|string|max:255',
            'ou_exercer' => 'required|string|max:255',
            'description' => 'required|string|',
            'autre_info' => 'string|nullable|max:255',
            'statut_juridique' => 'required|string|max:255',
            'numero_siret' => 'required|digits:14',
            'numero_siren' => 'required|digits:9',
            'code_naf' => 'alpha_num|min:5|max:5|nullable',
            'date_immatriculation' => 'required|date',
            'numero_tva' => 'alpha_num|min:13|max:13|nullable',
            'numero_rcs' => 'digits:9|nullable',
            'nom_legal' => 'string|nullable|max:255',
            'facebook' => 'string|nullable|max:255',
            'linkedin' => 'string|nullable|max:255',
            'twitter' => 'string|nullable|max:255',
            'instagram' => 'string|nullable|max:255',
            'nom_banque' => 'required|string|max:255',
            'numero_compte' => 'nullable|alpha_num|min:11|max:11',
            'iban' => 'required|alpha_num|min:14|max:34',
            'bic' => 'required|alpha_num|min:8|max:11',
            'numero_carte' => 'alpha_num|nullable|max:50',
            'nom_organisme_deliv' => 'string|nullable|max:255',
            'date_delivrance' => 'nullable|date',
            'numero_assurance' => 'alpha_num|nullable|max:50',
            'nom_organisme_assurance' => 'string|nullable|max:255',
            'type_piece_identite' => 'required|string|max:255',
            'piece_identite' => 'mimes:jpeg,png,pdf|max:5000',
            'livret_famille' => 'mimes:jpeg,png,pdf|max:5000',
            'rib_banque' => 'mimes:jpeg,png,pdf|max:5000',
            'registre_commerce' => 'mimes:jpeg,png,pdf|max:5000',
            'carte_pro' => 'mimes:jpeg,png,pdf|nullable|max:5000',
            'attestation_assurance' => 'mimes:jpeg,png,pdf|nullable|max:5000',
            
            
        ];
    }
}
