<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceHistory;
use App\Models\IpPhone;
use Illuminate\Http\Request;

class IpPhoneController extends Controller
{
    public function index()
    {
        return IpPhone::with('user')->get();
    }

    public function store(Request $request)
    {
        return IpPhone::create($request->all());
    }

    public function show(IpPhone $ipPhone)
    {
        return $ipPhone;
    }

    public function update(Request $request, IpPhone $ipPhone)
    {
        $oldLocation = $ipPhone->location;
        $newLocation = $request->input('location');

        if ($oldLocation !== $newLocation) {
            DeviceHistory::create([
                'device_type' => IpPhone::class,
                'device_id' => $ipPhone->id,
                'old_location' => $oldLocation,
                'new_location' => $newLocation,
                'reason' => $request->input('reason'),
            ]);
        }

        $ipPhone->update($request->all());

        return $ipPhone;
    }

    public function destroy(IpPhone $ipPhone)
    {
        $ipPhone->delete();

        return response()->noContent();
    }
}
