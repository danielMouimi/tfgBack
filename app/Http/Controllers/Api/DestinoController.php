<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Http\Requests\StoreDestinoRequest;

class DestinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinos = Destino::all();
        return response()->json($destinos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinoRequest $request)
    {
        $destino = Destino::create($request->validated());
        return response()->json([
            'message' => 'Destino creado correctamente',
            'data' => $destino
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $destino = Destino::find($id);

        if (!$destino) {
            return response()->json(['message' => 'Destino no encontrado'], 404);
        }

        return response()->json($destino, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDestinoRequest $request, string $id)
    {
        $destino = Destino::find($id);

        if (!$destino) {
            return response()->json(['message' => 'Destino no encontrado'], 404);
        }

        $destino->update($request->validated());

        return response()->json([
            'message' => 'Destino actualizado correctamente',
            'data' => $destino
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destino = Destino::find($id);

        if (!$destino) {
            return response()->json(['message' => 'Destino no encontrado'], 404);
        }

        $destino->delete();

        return response()->json(['message' => 'Destino eliminado correctamente'], 204);
    }
    public function getByName(string $name) {
        $name = trim($name);
        $destino = Destino::where('nombre', $name)->first();
        if (!$destino) {
            return response()->json(['message' => 'Destino no encontrado'], 404);
        }
        return response()->json($destino, 200);
    }
    public function getById(string $name) {
        $name = trim($name);
        $destino = Destino::where('id', $name)->first();
        if (!$destino) {
            return response()->json(['message' => 'Destino no encontrado'], 404);
        }
        return response()->json($destino, 200);
    }
}
