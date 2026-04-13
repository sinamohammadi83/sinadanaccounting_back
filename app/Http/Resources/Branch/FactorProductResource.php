<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FactorProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pivot = $this->pivot;
        return [
            'factor_id' => $pivot->factor_id,
            'product_id' => $pivot->product_id,
            'name' => $this->name,
            'count' => $pivot->count,
            'description' => $pivot->description,
            'unit' => $pivot->unit,
            'unit_price' => $pivot->unit_price,
            'tax' => $pivot->tax,
            'discount' => $pivot->discount,
            'total_price' => $pivot->total_price
        ];
    }
}
