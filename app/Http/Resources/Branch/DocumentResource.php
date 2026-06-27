<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'staff' => $this->staff,
            'accept_staff' => $this->accept_staff,
            'title' => $this->title,
            'type' => $this->type,
            'status' => $this->status,
            'date' => $this->date,
            'due_date' => $this->due_date
        ];
    }
}
