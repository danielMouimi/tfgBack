<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfertaTour;
use App\Http\Requests\StoreOfertaTourRequest;

class OfertaTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ofertaTours = OfertaTour::with(['oferta', 'tour'])->get();
        return response()->json($ofertaTours, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfertaTourRequest $request)
    {
        $ofertaTour = OfertaTour::create($request->validated());

        return response()->json([
            'message' => 'Oferta-Tour asociado correctamente',
            'data' => $ofertaTour
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ofertaTour = OfertaTour::with(['oferta', 'tour'])->find($id);

        if (!$ofertaTour) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($ofertaTour, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOfertaTourRequest $request, string $id)
    {
        $ofertaTour = OfertaTour::find($id);

        if (!$ofertaTour) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $ofertaTour->update($request->validated());

        return response()->json([
            'message' => 'Oferta-Tour actualizado correctamente',
            'data' => $ofertaTour
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ofertaTour = OfertaTour::find($id);

        if (!$ofertaTour) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $ofertaTour->delete();

        return response()->json(['message' => 'Eliminado correctamente'], 204);
    }
}
