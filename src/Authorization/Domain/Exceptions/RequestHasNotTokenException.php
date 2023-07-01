<?php

declare(strict_types=1);

namespace Src\Authorization\Domain\Exceptions;

use Src\Shared\Domain\GlobalExcepion;
use Symfony\Component\HttpFoundation\Response;

final class RequestHasNotTokenException extends GlobalExcepion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): int
    {
        return 9000;
    }

    public function errorMessage(): string
    {
        return sprintf('The authorization header is required.');
    }
    public function errorStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

}
