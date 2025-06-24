<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceHistory;

class DeviceHistoryController extends Controller
{
    public function index()
    {
        return DeviceHistory::with('device')->get();
    }

    public function show(DeviceHistory $history)
    {
        return $history;
    }
}
