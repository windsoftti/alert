<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'email' => 'required|email|min:5|max:255',
            'celular' => 'nullable|min:10|max:255',
            'password' => 'nullable|min:8|max:255',
            'tipo_id' => 'required|integer|min:1',
            'status_id' => 'required|integer|min:1',
            'asignado_id' => 'required|integer|min:1',
            'avatar' => 'mimes:jpeg,jpg,png,gif,svg',
            ];
    }
}
