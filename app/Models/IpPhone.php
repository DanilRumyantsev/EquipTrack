<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'phone_number',
        'assigned_to',
        'last_firmware_update',
        'location',
        'status',
    ];

    public function histories()
    {
        return $this->morphMany(DeviceHistory::class, 'device');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
