<?php

declare(strict_types=1);

namespace Src\Authorization\Application\ValidateAuthorization;

use Src\Authorization\Domain\Model\Authorization;
use Src\Authorization\Domain\Model\ValueObjects\AuthorizationToken;
use Src\Authorization\Application\ValidateAuthorization\ValidateAuthorizationCommand;

final class AuthorizationValidator
{

    public function __invoke(
        ValidateAuthorizationCommand $commnad
    ): void {
        $authorization = new Authorization(new AuthorizationToken($commnad->token()));
        $authorization->validateAuthorization();
    }
}
