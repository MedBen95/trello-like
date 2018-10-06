<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
          'name' => 'bail|required|max:255',
          'email' => 'bail|required|email|max:255',
          'telephone'=>'bail|nullable|numeric|regex:/(06)[0-9]{8}/',
          'adresse'=>'bail|nullable|min:10',
          'apropos'=>'bail|nullable|min:20'
        ];
    }
}
