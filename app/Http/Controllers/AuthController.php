<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $usuario = $request->input('Usuario');
        $password = $request->input('PasswordU');

        if (empty($usuario) || empty($password)) {
            return response()->json(['error' => 'Usuario y contraseña son requeridos.'], 400);
        }

        // Usando procedimiento almacenado (sp_ValidarUsuario)
        $result = DB::select('EXEC sp_ValidarUsuario @Usuario = ?, @PasswordU = ?', [$usuario, $password]);

        if (empty($result)) {
            return response()->json(['error' => 'Credenciales incorrectas.'], 401);
        }

        $user = $result[0]; // primer registro

        return response()->json([
            'usuario' => [
                'Id' => $user->Id,
                'Usuario' => $user->Usuario,
                'NombreCompleto' => $user->NombreCompleto,
                'Cargo' => $user->Cargo,
            ]
        ]);
    }
}

