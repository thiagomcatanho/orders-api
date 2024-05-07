<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function paginationInformation(Request $request, array $paginated): array
    {
        return [
            "current_page" => $paginated["current_page"],
            "first_page_url" => $paginated["first_page_url"],
            "from" => $paginated["from"],
            "next_page_url" => $paginated["next_page_url"],
            "path" => $paginated["path"],
            "per_page" => $paginated["per_page"],
            "prev_page_url" => $paginated["prev_page_url"],
            "to" => $paginated["to"],
        ];
    }
}
