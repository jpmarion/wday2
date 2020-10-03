<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @OA\Schema(
     *     schema="User",
     *     title="User",
     *     description="Representación del usuario",
     *     @OA\Property(type="integer", property="id", description="Id del usuario"),
     *     @OA\Property(type="string", property="name", description="Nombre del usuario"),
     *     @OA\Property(type="string", property="email", format="email", description="Email del usuario"),
     *     @OA\Property(type="string", format="date-time", property="email_verified_at", description="Cuando el usuario verifica su email", nullable=true),
     *     @OA\Property(type="boolean", property="active", description="Si usuario se encuentra activo")
     * )
     */
}
