<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{
    // Obtener todos los clientes
    public function todosClientes(): JsonResponse
    {
        try {
            $clientes = Cliente::all();
            return response()->json($clientes, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los clientes: ' . $e->getMessage()], 500);
        }
    }

    // Agregar un cliente nuevo
    public function agregarCliente(Request $request): JsonResponse
    {
        $request->validate([
            'Nombre' => 'required|string',
            'Telefono' => 'nullable|string',
        ]);

        try {
            $cliente = Cliente::create([
                'Nombre' => $request->Nombre,
                'Telefono' => $request->Telefono,
            ]);

            if ($cliente) {
                return response()->json(['mensaje' => 'Cliente agregado correctamente.'], 200);
            } else {
                return response()->json(['error' => 'No se pudo agregar el cliente.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al agregar el cliente: ' . $e->getMessage()], 500);
        }
    }
}
