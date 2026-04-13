<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->staff->name,
            'family' => $this->staff->family,
            'mobile' => $this->staff->mobile,
            'personal_code' => $this->staff->personal_code,
            'role' => $this->staff->role
        ];
    }
}
