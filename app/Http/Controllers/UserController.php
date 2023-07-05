<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $response = [
            'status' => 0,
            'result' => ''
        ];
        $usuario = User::where(['usuario' => $request->usuario])->first();
        if ($usuario) {
            if ($usuario['estado'] == 'inactivo') {
                $response['status'] = '400';
                $response['result'] = 'Aun no ha validado el Usuario';
                return response()->json($response, 200);
            }
            if (Hash::check($request->contrasena, $usuario->contrasena)) {
                $token = $usuario->createToken('example');
                $response['status'] = 'OK';
                $response['result'] = $token->plainTextToken;
            } else {
                $response['result'] = 'Credenciales incorrectas';
            }
        } else {
            $response['result'] = 'Credenciales incorrectas';
        }

        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'sesion cerrada']);
    }
}
