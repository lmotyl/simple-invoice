<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceFormRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'created' => date('Y-m-d', strtotime($this->input('created')))
        ]);
    }


    protected array $rules = [
        'number' => [
            'required',
            'string'
        ],
        'taxIdBuyer' => [
            'required',
            'numeric',
            'digits:10'
        ],
        'taxIdSeller' => [
            'required',
            'numeric',
            'digits:10'
        ],
        'productName' => [
            'required'
        ],
        'priceNET' => [
            'required',
            'integer'
        ],
        'created' => [
            'required',
            'date_format:Y-m-d'
        ]
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = $this->rules;
        $rules['number'][] = 'unique:invoices,number';

        return $rules;
    }
}
