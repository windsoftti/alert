<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProspecto extends FormRequest
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
            'nombre' => 'nullable|min:1|max:255',
            'celular' => 'nullable|min:10|max:255',
            'sequimiento_id' => 'nullable|integer|min:1',
            'status_id' => 'required|integer|min:1',
            'asignado_id' => 'nullable|integer|min:1',
            ];
    }
}
