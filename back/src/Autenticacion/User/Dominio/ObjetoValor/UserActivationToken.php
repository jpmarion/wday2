<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio\ObjetoValor;

final class UserActivationToken
{
    private $valor;

    /**
     * UserActivationToken construc
     * @param string $activationToken
     */
    public function __construct(string $activationToken)
    {
        $this->valor = $activationToken;
    }

    /**
     * @return string ActivationToken
     */
    public function Valor(): string
    {
        return $this->valor;
    }
}
