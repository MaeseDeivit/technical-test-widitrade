<?php

namespace Src\Authorization\Infrastructure\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Src\Shared\Infrastructure\Middleware\ApiMiddleware;
use Src\Authorization\Domain\Exceptions\RequestHasNotTokenException;
use Src\Authorization\Application\ValidateAuthorization\ValidateAuthorizationCommand;
use Src\Authorization\Domain\Exceptions\TokenNotValidException;

class CheckIfAuthentificationIsValidMiddleware extends ApiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $this->validateRequest($request);

            $this->dispatch(
                new ValidateAuthorizationCommand(
                    $request->bearerToken()
                )
            );

            return $next($request);
        } catch (RequestHasNotTokenException $ex) {
            return $this->errorResponse($ex->errorStatusCode(), $ex->errorCode(), $ex->errorMessage());
        } catch (TokenNotValidException $ex) {
            return $this->errorResponse($ex->errorStatusCode(), $ex->errorCode(), $ex->errorMessage());
        }
    }

    private function validateRequest(Request $request): void
    {
        if (is_null($request->bearerToken())) {
            throw new RequestHasNotTokenException();
        }
    }
}
