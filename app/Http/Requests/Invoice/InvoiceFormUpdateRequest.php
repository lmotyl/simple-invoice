<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceFormUpdateRequest extends InvoiceFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = $this->rules;
        $rules['id'][] = 'exists:invoices,id';
//        dump($rules);
        $rules['number'][] = Rule::unique('invoices', 'number')->ignore($this->input('id'));

        return $rules;
    }
}
