<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio\Interfaces;

use Src\Autenticacion\User\Dominio\UserDmn;

interface UserRepositorioItf
{
    public function save(UserDmn $userDmn): void;
    public function notify(): void;
}
