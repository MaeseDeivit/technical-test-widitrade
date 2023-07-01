<?php

declare(strict_types=1);

namespace Src\Authorization\Application\ValidateAuthorization;

use Src\Shared\Domain\Bus\Command\Command;

final class ValidateAuthorizationCommand implements Command
{
    public function __construct(
        private readonly string $token
    ) {
    }

    public function token(): string
    {
        return $this->token;
    }
}
