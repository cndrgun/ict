<?php

namespace App\Http\Requests;

use App\Rules\MaxDateDifference;
use App\Traits\HttpResponses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderListRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {

        return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'customer_id' => ['required', 'exists:App\Models\Customers,id'],
            'order_no' => ['nullable', 'string', "exists:App\Models\Orders,order_no"],
        ];

    }

    public function messages()
    {
       
        return [
            'customer_id.required' => 'Kullanıcı idsi zorunludur.',
            'customer_id.exists' => 'Geçersiz kullanıcı idsi. Lütfen mevcut bir customer_id giriniz.',
            'order_no.exists' => 'Girilen sipariş numarası geçersiz.',
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
