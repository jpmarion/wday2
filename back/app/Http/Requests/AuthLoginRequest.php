<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|string|confirmed',
            'remember_me' => 'boolean'
        ];
    }

    /**
     * @OA\Schema(
     *     schema="AuthLoginRequest",
     *     title="AuthLoginRequest",
     *     description="Login Request",
     *     @OA\Property(type="string", property="email", format="email", description="Email del usuario"),
     *     @OA\Property(type="string", property="password", format="password", description="Contraseña del usuario"),
     *     @OA\Property(type="boolean", property="remember_me",  description="Recordar conexión del usuario")
     * )
     */
}
