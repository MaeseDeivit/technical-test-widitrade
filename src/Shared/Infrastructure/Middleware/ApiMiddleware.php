<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Middleware;

use Src\Shared\Domain\Bus\Command\Command;
use Src\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Src\Shared\Infrastructure\Responses\ErrorJsonResponse;
use Src\Shared\Infrastructure\Responses\SuccessJsonResponse;

abstract class ApiMiddleware
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }

    public function errorResponse(int $httpCode, int $errorCode = 0, mixed $errorMessage = null): JsonResponse
    {
        return ErrorJsonResponse::create(
            $httpCode,
            [
                'errorCode' => $errorCode,
                'errorMessage' => $errorMessage
            ],
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}
