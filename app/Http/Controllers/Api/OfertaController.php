<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oferta;
use App\Http\Requests\StoreOfertaRequest;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ofertas = Oferta::with('tours')->get();
        return response()->json($ofertas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfertaRequest $request)
    {
        $oferta = Oferta::create($request->validated());

        return response()->json([
            'message' => 'Oferta creada correctamente',
            'data' => $oferta
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $oferta = Oferta::with('tours')->find($id);

        if (!$oferta) {
            return response()->json(['message' => 'Oferta no encontrada'], 404);
        }

        return response()->json($oferta, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOfertaRequest $request, string $id)
    {
        $oferta = Oferta::find($id);

        if (!$oferta) {
            return response()->json(['message' => 'Oferta no encontrada'], 404);
        }

        $oferta->update($request->validated());

        return response()->json([
            'message' => 'Oferta actualizada correctamente',
            'data' => $oferta
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oferta = Oferta::find($id);

        if (!$oferta) {
            return response()->json(['message' => 'Oferta no encontrada'], 404);
        }

        $oferta->delete();

        return response()->json(['message' => 'Oferta eliminada correctamente'], 204);
    }

    public function getById(string $id) {
        $ofertas = Oferta::where('usuario_id', $id)->with('tours')->get();

        if (!$ofertas) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($ofertas, 200);

    }
}
