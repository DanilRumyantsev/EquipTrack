<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_type',
        'device_id',
        'old_location',
        'new_location',
        'reason',
    ];

    public function device()
    {
        return $this->morphTo();
    }
}
