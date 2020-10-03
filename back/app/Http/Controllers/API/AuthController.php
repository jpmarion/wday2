<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthSignupRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 *  @OA\Info(
 *      description="Backend sistema de gestión de personal",
 *      version="1.0.0",
 *      title="wday2",
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      ),
 *      contact={"email": "totomarion@gmail.com"}
 *  )
 *
 *  @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *  )
 */

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/auth/signup",
     *      tags={"AuthController"},
     *      summary="Signup de usuario",
     *      operationId="signupAuthController",
     *      @OA\Parameter(
     *          name="Signup",
     *          in="query",
     *          @OA\JsonContent(ref="#/components/schemas/AuthSignupRequest"),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Usuario creado",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Solicitud no válida"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="No autorizado"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error validación"
     *      )
     *)
     */
    public function signup(AuthSignupRequest $request)
    {
        $user = new User([
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ]);
        $user->save();
        return response()->json(['mensaje' => "Usuario creado exitosamente"], 201);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"AuthController"},
     *      summary="Login de usuario",
     *      operationId="loginAuthController",
     *      @OA\Parameter(
     *          name="login",
     *          in="query",
     *          @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Usuario logueado",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Solicitud no válida"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="No autorizado"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error validación"
     *      )
     *)
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['mensaje' => 'No autorizado'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addHour(8);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/logout",
     *      tags={"AuthController"},
     *      summary="Logout de usuario",
     *      operationId="logoutAuthController",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Sesión cerrada",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Solicitud no válida"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="No autorizado"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No encontrado"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error validación"
     *      )
     *  )
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'mensaje' => 'Cerrar sesión correctamente'
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/user",
     *      tags={"AuthController"},
     *      summary="Datos del usuario",
     *      operationId="user",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Usuario",
     *          @OA\JsonContent(ref="#/components/schemas/User"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Solicitud no válida"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="No autorizado"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No encontrado"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error validación"
     *      )
     *  )
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
