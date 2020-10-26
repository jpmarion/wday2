<?php

declare(strict_types=1);

namespace Src\Autenticacion\User\Dominio;

use Src\Autenticacion\User\Dominio\ObjetoValor\UserActivationToken;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserEmail;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserName;
use Src\Autenticacion\User\Dominio\ObjetoValor\UserPassword;

final class UserDmn
{
    private $name;
    private $email;
    private $password;
    private $activationToken;

    /**
     * UserDmn construct
     * @param UserName $userName
     * @param UserEmail $userEmail
     * @param UserPassword $userPassword
     * @param UserActivationToken $userActivationToken
     */
    public function __construct(
        UserEmail $userEmail,
        UserPassword $userPassword,
        UserActivationToken $userActivationToken
    ) {
        $this->name = new UserName('');
        $this->email = $userEmail;
        $this->password = $userPassword;
        $this->activationToken = $userActivationToken;
    }

    /**
     * @return UserName name
     */
    public function Name(): UserName
    {
        return $this->name;
    }

    /**
     * @return UserEmail email
     */
    public function Email(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPassword password
     */
    public function Password(): UserPassword
    {
        return $this->password;
    }

    /**
     * @return UserActivationToken activationToken
     */
    public function ActivationToken(): UserActivationToken
    {
        return $this->activationToken;
    }
}
