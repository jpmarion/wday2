<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetCreateRequest;
use App\Http\Requests\PasswordResetResetRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequestNotification;
use App\Notifications\PasswordResetSuccessNotification;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(PasswordResetCreateRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'mensaje' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.'
            ], 404);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => bcrypt($user->email)
            ]
        );
        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequestNotification($passwordReset->token)
            );
            return response()->json([
                'mensaje' => '¡Hemos enviado un correo electrónico con el enlace de restablecimiento de contraseña!'
            ]);
        }
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset) {
            return response()->json([
                'mensaje' => 'Este token de restablecimiento de contraseña no es válido.'
            ], 404);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'mensaje' => 'Este token de restablecimiento de contraseña no es válido.'
            ], 404);
        }
        return response()->json($passwordReset);
    }

    public function reset(PasswordResetResetRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if (!$passwordReset) {
            return response()->json([
                'mensaje' => 'Este token de restablecimiento de contraseña no es válido.'
            ], 404);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'mensaje' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.'
            ], 404);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccessNotification($passwordReset));
        return response()->json($user);
    }
}
