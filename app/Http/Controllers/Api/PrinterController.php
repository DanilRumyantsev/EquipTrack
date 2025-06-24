<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceHistory;
use App\Models\Printer;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function index()
    {
        return Printer::all();
    }

    public function store(Request $request)
    {
        return Printer::create($request->all());
    }

    public function show(Printer $printer)
    {
        return $printer;
    }

    public function update(Request $request, Printer $printer)
    {
        $oldLocation = $printer->location;
        $newLocation = $request->input('location');

        if ($oldLocation !== $newLocation) {
            DeviceHistory::create([
                'device_type' => Printer::class,
                'device_id' => $printer->id,
                'old_location' => $oldLocation,
                'new_location' => $newLocation,
                'reason' => $request->input('reason'),
            ]);
        }

        $printer->update($request->all());

        return $printer;
    }

    public function destroy(Printer $printer)
    {
        $printer->delete();

        return response()->noContent();
    }
}
