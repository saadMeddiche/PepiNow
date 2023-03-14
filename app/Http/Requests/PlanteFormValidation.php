<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanteFormValidation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nom'=>[
                'string',
                'required',
                'max:30'
            ],
            'description'=>[
                'string',
                'required',
                'max:300'
            ],
            'price'=>[
                'integer',
                'required',
            ],
            'image'=>[
                // 'sometimes',
                $this->isMethod('put') ? 'nullable' : 'required',
                'mimes:jpeg,jpg,png'
            ],
            'categorie_id'=>[
                'integer',
                'required',
                'exists:categories,id',
            ]
        ];
    }
}
