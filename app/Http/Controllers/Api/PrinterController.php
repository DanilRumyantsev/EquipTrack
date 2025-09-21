<?php

namespace App\Http\Controllers\Api;

use App\DataTransferObject\Printer\CreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Printer\CreateRequest;
use App\Http\Requests\Printer\UpdateRequest;
use App\Http\Resources\Printer\PrinterResource;
use App\Models\DeviceHistory;
use App\Models\Printer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PrinterController extends Controller
{
    /**
     * Вывод всех принтеров.
     */
    public function index(): JsonResponse
    {
        return PrinterResource::collection(Printer::all())->response();
    }

    /**
     * Создание принтера.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $dto = CreateDTO::fromArray($request->all());

        return (new PrinterResource(Printer::create($dto->toArray())))->response();
    }

    public function show(Printer $printer): Printer
    {
        return $printer;
    }

    public function update(UpdateRequest $request, Printer $printer)
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

    public function destroy(Printer $printer): Response
    {
        $printer->delete();

        return response()->noContent();
    }
}
