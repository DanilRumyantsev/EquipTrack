<?php

namespace App\DataTransferObject\Printer;

class CreateDTO
{
    public function __construct(
        public readonly string $model,
        public readonly string $ip_address,
        public readonly string $mac_address,
        public readonly string $location,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            model: $data['model'],
            ip_address: $data['ip_address'],
            mac_address: $data['mac_address'],
            location: $data['location'],
            status: $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'ip_address' => $this->ip_address,
            'mac_address' => $this->mac_address,
            'location' => $this->location,
            'status' => $this->status,
        ];
    }
}
