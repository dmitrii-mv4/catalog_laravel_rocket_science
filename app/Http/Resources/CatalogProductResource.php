<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CatalogProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'category' => $this->category->title ?? null,
            'colors' => $this->colors->pluck('title'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
