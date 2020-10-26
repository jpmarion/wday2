<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Infraestructura\Interfaces;

use Illuminate\Http\Request;

interface AutenticacionItf
{
    public function signup(Request $request): void;
}
