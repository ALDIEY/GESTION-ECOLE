<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreeRequet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'notemax'=>'required|numeric',
            'classe_id'=>'required|numeric',
            'annee_id'=>'required|numeric',
            'discipline_id'=>'required|numeric',
            'evaluation_id'=>'required|numeric'

            //
        ];
    }
   public function messages():array
   {
    return [
        'notemax.required'=>'erreur'    ];
   }
}
