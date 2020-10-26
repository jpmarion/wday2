<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Aplicacion;

use Src\Autenticacion\User\Dominio\Interfaces\UserRepositorioItf;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserActivationToken;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserEmail;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserName;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserPassword;
use Src\Autenticacion\User\Dominio\UserDmn;

final class SignupUserCU
{
    private $repositorio;

    /**
     * SignupUserCU construct
     * @param UserRepositorioItf $repositorio
     */
    public function __construct(UserRepositorioItf $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $activationToken
     */
    public function __invoke(
        string $email,
        string $password,
        string $activationToken
    ) {
        $email = new UserEmail($email);
        $password = new UserPassword($password);
        $activationToken = new UserActivationToken($activationToken);
        $user = new UserDmn($email, $password, $activationToken);
        $this->repositorio->save($user);
    }
}
