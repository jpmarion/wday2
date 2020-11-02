<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Infraestructura\Factorias;

use App\Notifications\SignupActivate;
use Src\Autenticacion\User\Infraestructura\Enum\TipoNotificacionEnum;
use App\Models\User as EloquentUserModel;

class TipoNotificacionFct
{
    public function __construct()
    {
    }

    public function __invoke(int $tipoNotificacionEnum, EloquentUserModel $eloquentUserModel = null)
    {
        switch ($tipoNotificacionEnum) {
            case TipoNotificacionEnum::SignupActivate:
                return new SignupActivate($eloquentUserModel);
                break;
            default:
                throw new Exception("Tipo notificación no soportado");
                break;
        }
    }
}
