<?php

namespace App\Http\Requests;

use App\Data\ClientData;
use App\Models\Client;
use App\Support\BaseRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => [
                'required',
                'string',
                Rule::unique(Client::class, 'phone')
                    ->ignore($this->route('client')->id, 'id')
                    ->whereNull('deleted_at')
            ],
            'address' => ['required', 'string'],
            'address_no' => ['required', 'string'],
            'address_complement' => ['sometimes', 'required', 'string'],
            'neighborhood' => ['required', 'string'],
        ];
    }

    public function data(): ClientData
    {
        return ClientData::from($this->validated());
    }
}
