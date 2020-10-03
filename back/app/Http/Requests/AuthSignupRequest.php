<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthSignupRequest extends FormRequest
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
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string'
        ];
    }

    /**
     * @OA\Schema(
     *     schema="AuthSignupRequest",
     *     title="AuthSignupRequest",
     *     description="Signup Request",
     *     @OA\Property(type="string", property="email", format="email", description="Email del usuario"),
     *     @OA\Property(type="string", property="password", format="password", description="Contraseña del usuario"),
     *     @OA\Property(type="string", property="password_confirmation", format="password", description="Confirmar contraseña del usuario")
     * )
     */
}
