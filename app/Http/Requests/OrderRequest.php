<?php

namespace App\Http\Requests;

use App\Data\OrderData;
use App\Enums\PaymentForm;
use App\Models\Client;
use App\Models\Product;
use App\Support\BaseRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => ['required', Rule::exists(Client::class, 'id')],
            'payment_form' => ['required', Rule::enum(PaymentForm::class)],
            'products' => ['required', 'array'],
            'products.*.product_id' => ['required', Rule::exists(Product::class, 'id')],
            'products.*.quantity' => ['required', 'min:0'],
        ];
    }

    public function data(): OrderData
    {
        return OrderData::from($this->validated());
    }
}
