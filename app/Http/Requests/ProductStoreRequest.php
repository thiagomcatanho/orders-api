<?php

namespace App\Http\Requests;

use App\Data\ProductData;
use App\Models\Product;
use App\Support\BaseRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Product::class, 'name')->whereNull('deleted_at')
            ],
            'price' => ['required', 'numeric', 'min:0']
        ];
    }

    public function data(): ProductData
    {
        return ProductData::from($this->validated());
    }
}
