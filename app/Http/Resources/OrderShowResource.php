<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "payment_form" => $this->payment_form,
            "stauts" => $this->status,
            "amount" => round($this->amount, 2),
            "created_at" => Carbon::create($this->created_at)->format('d/m/Y H:i:s'),
            "client" => $this->client,
            "items" => $this->items
        ];
    }

    public function paginationInformation(Request $request, array $paginated): array
    {
        return $paginated;
    }
}
