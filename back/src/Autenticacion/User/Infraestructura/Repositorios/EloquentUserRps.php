<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Infraestructura\Repositorios;

use App\Models\User as EloquentUserModel;
use Src\Autenticacion\User\Dominio\Interfaces\UserRepositorioItf;
use Src\Autenticacion\User\Dominio\UserDmn;
use Src\Autenticacion\User\Infraestructura\Enum\TipoNotificacionEnum;
use Src\Autenticacion\User\Infraestructura\Factorias\TipoNotificacionFct as FactoriasTipoNotificacionFct;

final class EloquentUserRps implements UserRepositorioItf
{
    private $eloquentUserModel;

    /**
     * EloquentUserRps construct
     */
    public function __construct()
    {
        $this->eloquentUserModel = new EloquentUserModel;
    }

    /**
     * @param UserDmn $userDmn
     * @return void
     */
    public function save(UserDmn $userDmn): void
    {
        $this->eloquentUserModel->email = $userDmn->Email()->Valor();
        $this->eloquentUserModel->password = $userDmn->Password()->Valor();
        $this->eloquentUserModel->activation_token = $userDmn->ActivationToken()->Valor();
        $this->eloquentUserModel->save();
    }

    /**
     *
     */
    public function notify(int $tipoNotificacionEnum): void
    {
        $tipoNotificacionFct = new FactoriasTipoNotificacionFct;
        $notificacion = $tipoNotificacionFct->__invoke($tipoNotificacionEnum, $this->eloquentUserModel);
        $this->eloquentUserModel->notify($notificacion);
    }
}
