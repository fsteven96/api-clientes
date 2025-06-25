<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AtencionController extends Controller
{
    // GET /api/atenciones
    public function index(): JsonResponse
    {
        try {
            $atenciones = DB::select('EXEC sp_ObtenerAtenciones');
            return response()->json($atenciones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener atenciones: ' . $e->getMessage()], 500);
        }
    }

    // POST /api/atenciones
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'CitaId' => 'required|integer|min:1',
            'Descripcion' => 'required|string',
        ]);

        try {
            DB::statement('EXEC sp_GuardarAtencion @CitaId = ?, @Descripcion = ?', [
                $request->CitaId,
                $request->Descripcion
            ]);

            return response()->json(['mensaje' => 'Atención guardada y cita marcada como Culminada.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la atención: ' . $e->getMessage()], 500);
        }
    }
}
