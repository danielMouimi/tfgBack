<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourRequest;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with(['etapas', 'oferta'])->get();
        return response()->json($tours, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        $tour = Tour::create($request->validated());

        return response()->json([
            'message' => 'Tour creado correctamente',
            'data' => $tour
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Tour::with(['etapas', 'oferta'])->find($id);

        if (!$tour) {
            return response()->json(['message' => 'Tour no encontrado'], 404);
        }

        return response()->json($tour, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTourRequest $request, string $id)
    {
        $tour = Tour::find($id);

        if (!$tour) {
            return response()->json(['message' => 'Tour no encontrado'], 404);
        }

        $tour->update($request->validated());


        return response()->json([
            'message' => 'Tour actualizado correctamente',
            'data' => $tour
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Tour::find($id);

        if (!$tour) {
            return response()->json(['message' => 'Tour no encontrado'], 404);
        }

        $tour->delete();

        return response()->json(['message' => 'Tour eliminado correctamente'], 204);
    }
}
