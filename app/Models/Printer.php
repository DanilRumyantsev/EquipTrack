<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Printer extends Model
{
    protected $fillable = [
        'model',
        'ip_address',
        'mac_address',
        'location',
        'status',
    ];

    public function histories(): morphMany
    {
        return $this->morphMany(DeviceHistory::class, 'device');
    }
}
