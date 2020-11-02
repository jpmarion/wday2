<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Infraestructura;

use Illuminate\Http\Request;
use Src\Autenticacion\User\Aplicacion\SignupUserCU;
use Src\Autenticacion\User\Dominio\Interfaces\UserRepositorioItf;
use Src\Autenticacion\User\Infraestructura\Interfaces\AutenticacionItf;

final class AutenticacionCtrl implements AutenticacionItf
{
private $repositorio;

    public function __construct(UserRepositorioItf $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function signup(Request $request): void
    {
        $userEmail = $request->email;
        $userPassword = $request->password;
        $userActivationToken = bcrypt($request->email);

        $sigunoUserCU = new SignupUserCU($this->repositorio);
        $sigunoUserCU->__invoke($userEmail,$userPassword,$userActivationToken);
    }
}
