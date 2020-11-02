<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio\Interfaces;

use Src\Autenticacion\User\Dominio\UserDmn;
use Src\Autenticacion\User\Infraestructura\Enum\TipoNotificacionEnum;

interface UserRepositorioItf
{
    public function save(UserDmn $userDmn): void;
    public function notify(int $tipoNotificacionEnum): void;
}
