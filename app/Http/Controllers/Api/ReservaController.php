<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Http\Requests\StoreReservaRequest;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('users')->with('tours')->get();
        return response()->json($reservas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservaRequest $request)
    {
        $reserva = Reserva::create($request->validated());

        return response()->json([
            'message' => 'Reserva creada correctamente',
            'data' => $reserva
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reserva = Reserva::with(['users', 'tours'])->find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        return response()->json($reserva, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReservaRequest $request, string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $reserva->update($request->validated());

        return response()->json([
            'message' => 'Reserva actualizada correctamente',
            'data' => $reserva
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $reserva->delete();

        return response()->json(['message' => 'Reserva eliminada'], 204);
    }

    public function getReservasByUser(string $id) {
        $reservas = Reserva::with('users')->with('tours')->where('usuario_id',$id)->get();
        if (!$reservas) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }
        return response()->json($reservas, 200);
    }
}
