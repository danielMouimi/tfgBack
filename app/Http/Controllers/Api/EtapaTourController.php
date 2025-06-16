<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EtapaTour;
use App\Http\Requests\StoreEtapaTourRequest;

class EtapaTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etapas = EtapaTour::with(['tour', 'destino'])->get();
        return response()->json($etapas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtapaTourRequest $request)
    {
        $etapa = EtapaTour::create($request->validated());

        return response()->json([
            'message' => 'Etapa de tour creada correctamente',
            'data' => $etapa
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etapa = EtapaTour::with(['tour', 'destino'])->find($id);

        if (!$etapa) {
            return response()->json(['message' => 'Etapa no encontrada'], 404);
        }

        return response()->json($etapa, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEtapaTourRequest $request, string $id)
    {
        $etapa = EtapaTour::find($id);

        if (!$etapa) {
            return response()->json(['message' => 'Etapa no encontrada'], 404);
        }

        $etapa->update($request->validated());

        return response()->json([
            'message' => 'Etapa actualizada correctamente',
            'data' => $etapa
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etapa = EtapaTour::find($id);

        if (!$etapa) {
            return response()->json(['message' => 'Etapa no encontrada'], 404);
        }

        $etapa->delete();

        return response()->json(['message' => 'Etapa eliminada correctamente'], 204);
    }

    public function getById(string $id) {
        $etapa = EtapaTour::with(['tour', 'destino'])->where('tour_id',$id)->get();
        if (!$etapa) {
            return response()->json(['message' => 'Etapa no encontrada'], 404);
        }
        return response()->json($etapa, 200);
    }

    public function deleteByTourId(string $id) {
        $etapas = EtapaTour::with(['tour', 'destino'])->where('tour_id',$id)->get();
        if (!$etapas) {
            return response()->json(['message' => 'Etapa no encontrada'], 404);
        }
        foreach ($etapas as $etapa) {
            $etapa->delete();
        }

    }
}
