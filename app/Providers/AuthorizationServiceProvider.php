<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Authorization\Application\ValidateAuthorization\ValidateAuthorizationCommandHandler;

class AuthorizationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->tag(
            ValidateAuthorizationCommandHandler::class,
            'command_handler'
        );
    }
}
