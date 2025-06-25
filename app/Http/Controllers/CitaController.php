<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class CitaController extends Controller
{
    // Obtener citas activas usando el stored procedure
    public function obtenerCitasActivas(): JsonResponse
    {
        try {
            $citas = DB::select('EXEC sp_ObtenerCitasActivas');

            return response()->json($citas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las citas activas: ' . $e->getMessage()], 500);
        }
    }

    // Crear una nueva cita usando stored procedure
    public function crearCita(Request $request): JsonResponse
    {
        $request->validate([
            'ClienteId' => 'required|integer',
            'FechaHora' => 'required|date',
            'Estado' => 'required|string',
        ]);

        try {
            DB::statement('EXEC AgregarCita @ClienteId = ?, @FechaHora = ?, @Estado = ?', [
                $request->ClienteId,
                $request->FechaHora,
                $request->Estado,
            ]);

            return response()->json(['mensaje' => 'Cita creada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la cita: ' . $e->getMessage()], 500);
        }
    }
}
