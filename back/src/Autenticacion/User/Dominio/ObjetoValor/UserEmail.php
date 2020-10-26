<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio\ObjetoValor;

use InvalidArgumentException;

final class UserEmail
{
    private $valor;

    /**
     * UserEmail constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->Validar($email);
        $this->valor = $email;
    }

    /**
     * @param string $email
     * @throws InvalidArgumentException
     */
    public function Validar(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('Email invalido', static::class, $email));
        }
    }

    /**
     * @return string email
     */
    public function valor(): string
    {
        return $this->valor;
    }
}
