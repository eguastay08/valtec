<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use validator;

class CategoriaStoreRequest extends FormRequest
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
            //
            'categoria'=>'required|max:40'
        ];
    }

    public function messages()
    {
        return [
            'categoria.required' => 'El campo Categoria es requerido',
            'categoria.max' => 'El campo Categoria debe contener como máximo 40 carácteres',
        ];
    }

    // public function validate() {
    //     $instance = $this->getValidatorInstance();
    //     if ($instance->fails()) {
    //         return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
    //     }
    // }
}
