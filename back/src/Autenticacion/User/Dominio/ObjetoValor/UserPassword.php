<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio\ObjetoValor;

final class UserPassword
{
    private $valor;

    /**
     * UserPassword construct
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->valor = $password;
    }

    /**
     * @return password
     */
    public function Valor(): string
    {
        return $this->valor;
    }
}
