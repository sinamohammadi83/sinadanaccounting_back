<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FactorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'staff_id' => $this->staff_id,
            'category_id' => $this->category_id,
            'category' => $this->category,
            'person_id' => $this->person_id,
            'person' => new PersonResource($this->person),
            'title' => $this->title,
            'date' => $this->date,
            'due_date' => $this->due_date,
            'paid_price' => $this->paid_price,
            'total_price' => $this->total_price,
            'type' => $this->type,
            'products' => FactorProductResource::collection($this->factorProduct)
        ];
    }
}
