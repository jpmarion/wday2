<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetResetRequest extends FormRequest
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
            'password' => 'required|string',
            'token' => 'required|string',
        ];
    }

    /**
     * @OA\Schema(
     *     schema="PasswordResetResetRequest",
     *     title="PasswordResetResetRequest",
     *     description="Password Reset Request",
     *     @OA\Property(type="string", property="email", format="email", description="Email del usuario"),
     *     @OA\Property(type="string", property="password", format="password", description="Contraseña del usuario"),
     *     @OA\Property(type="string", property="token", description="Token del usuario")
     * )
     */
}
