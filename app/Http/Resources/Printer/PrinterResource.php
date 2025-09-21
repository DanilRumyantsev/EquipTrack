<?php

namespace App\Http\Resources\Printer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrinterResource extends JsonResource
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
            'model' => $this->model,
            'ip_address' => $this->ip_address,
            'mac_address' => $this->mac_address,
            'location' => $this->location,
            'status' => $this->status,
        ];
    }
}
