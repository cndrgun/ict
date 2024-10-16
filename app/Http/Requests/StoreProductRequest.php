<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


use App\Rules\UniqueProductName;

class StoreProductRequest extends FormRequest
{

    public function authorize()
    {

        return true;

    }

    public function rules()
    {

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                new UniqueProductName()
            ],
            'description' => 'nullable|string|max:1000',
            'stock_status' => 'required|boolean',
        ];

    }

    public function messages()
    {

        return [
            'name.required' => 'Ürün ismi zorunludur.',
            'name.min' => 'Ürün ismi en az 3 karakter olabilir.',
            'name.max' => 'Ürün ismi en fazla 255 karakter olabilir.',
            'description.max' => 'Açıklama en fazla 1000 karakter olabilir.',
            'stock_status.required' => 'Stok Durumu Zorunludur',
            'stock_status.boolean' => 'Stok Durumu Boolean olmalıdır',
        ];

    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException($this->error($validator->errors()->toArray(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, 'Lütfen alanları kontrol ediniz!'));

    }

    public function error($errors, $statusCode = ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, $message = 'Validation Error')
    {

        return response()->json([
            'status'    => false,
            'message'   => $message,
            'errors'    => $errors,
        ], $statusCode);
        
    }
}
