<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio\ObjetoValor;

final class UserName
{
    private $valor;

    /**
     * UserName constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->valor = $name;
    }

    /**
     * @return string name
     */
    public function valor(): string
    {
        return $this->valor;
    }
}
