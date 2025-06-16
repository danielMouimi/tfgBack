<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReservaTour;
use App\Http\Requests\StoreReservaTourRequest;

class ReservaTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ReservaTour::with(['reserva', 'tour'])->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservaTourRequest $request)
    {
        $reservaTour = ReservaTour::create($request->validated());

        return response()->json([
            'message' => 'Reserva-Tour creada correctamente',
            'data' => $reservaTour
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservaTour = ReservaTour::with(['reserva', 'tour'])->find($id);

        if (!$reservaTour) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($reservaTour, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReservaTourRequest $request, string $id)
    {
        $reservaTour = ReservaTour::find($id);

        if (!$reservaTour) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $reservaTour->update($request->validated());

        return response()->json([
            'message' => 'Actualizado correctamente',
            'data' => $reservaTour
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservaTour = ReservaTour::find($id);

        if (!$reservaTour) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $reservaTour->delete();

        return response()->json(['message' => 'Eliminado correctamente'], 204);
    }
}
