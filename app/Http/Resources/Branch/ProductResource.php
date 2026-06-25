<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "name" => $this->name,
            "buy_price" => $this->buy_price,
            "sell_price" => $this->sell_price,
            "pic" => env("BASE_URL_PIC") ."storage/". $this->pic,
            "count" => $this->count,
            "category" => $this->category,
            "product_code" => $this->product_code,
        ];
    }
}
