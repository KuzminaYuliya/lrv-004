<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Car::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return bool
     */
    public function store(CarRequest $request)
    {
        return Car::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        return Car::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param Car $car
     * @return bool
     */
    public function update(CarRequest $request, Car $car): bool
    {
        $car->fill($request->validated());
        return $car->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return Response
     */
    public function destroy(Car $car): ?Response
    {
        if ($car->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
