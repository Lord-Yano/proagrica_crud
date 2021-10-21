<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //set to false once auth has been set
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            // name of fields to be validated | rule 1|rule2
            'name' => 'required|max:255',
            // email has to be unique in the users table
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:8|max:255'
        ];
    }
}
