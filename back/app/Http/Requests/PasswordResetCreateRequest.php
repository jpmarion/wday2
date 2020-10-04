<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetCreateRequest extends FormRequest
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
            'email' => 'required|email|max:255'
        ];
    }

    /**
     * @OA\Schema(
     *     schema="PasswordResetCreateRequest",
     *     title="PasswordResetCreateRequest",
     *     description="Password Reset Create Request",
     *     @OA\Property(type="string", property="email", format="email", description="Email del usuario")
     * )
     */
}
