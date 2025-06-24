<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'ip_address',
        'mac_address',
        'location',
        'status',
    ];

    public function histories()
    {
        return $this->morphMany(DeviceHistory::class, 'device');
    }
}
