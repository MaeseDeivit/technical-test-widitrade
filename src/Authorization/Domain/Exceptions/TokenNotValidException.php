<?php

declare(strict_types=1);

namespace Src\Authorization\Domain\Exceptions;

use Src\Shared\Domain\GlobalExcepion;
use Symfony\Component\HttpFoundation\Response;

final class TokenNotValidException extends GlobalExcepion
{
    public function __construct(private readonly string $value)
    {
        parent::__construct();
    }

    public function errorCode(): int
    {
        return 500;
    }

    public function errorMessage(): string
    {
        return sprintf('The token %s is not valid.', $this->value);
    }
    public function errorStatusCode(): int
    {
        return Response::HTTP_CONFLICT;
    }
}
