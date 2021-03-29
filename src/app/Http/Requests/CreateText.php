<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateText extends FormRequest
{
    public function validationData()
    {
        $input = parent::all();

        $input['abstract'] = strip_tags($input['abstract']);

        return $input;
    }


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
          'name' => 'required',
          'abstract' => 'max:1000'
           ];
    }
}
