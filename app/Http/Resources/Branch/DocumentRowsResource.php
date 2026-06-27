<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentRowsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'document_row_id' => $this->id,
            'account_id' => $this->account_id,
            'document_id' => $this->document_id,
            'account_name' => $this->account_name,
            'account_code' => $this->account_code,
            'description' => $this->description,
            'detailed_code' => $this->detailed_code,
            'debtor' => $this->debtor,
            'creditor' => $this->creditor,
        ];
    }
}
