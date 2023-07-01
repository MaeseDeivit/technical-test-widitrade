<?php

declare(strict_types=1);

namespace Src\Authorization\Domain\Model;

use Src\Shared\Domain\Aggregate\AggregateRoot;
use Src\Authorization\Domain\Model\ValueObjects\AuthorizationToken;

class Authorization extends AggregateRoot
{
    public function __construct(private readonly AuthorizationToken $token)
    {
    }
    public function validateAuthorization(): void
    {
        $this->token->validateToken();
    }
}
