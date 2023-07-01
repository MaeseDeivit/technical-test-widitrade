<?php

declare(strict_types=1);

namespace Src\Authorization\Application\ValidateAuthorization;

use Src\Shared\Domain\Bus\Command\CommandHandler;
use Src\Authorization\Application\ValidateAuthorization\ValidateAuthorizationCommand;


final class ValidateAuthorizationCommandHandler implements CommandHandler
{

    public function __construct(private readonly AuthorizationValidator $validator)
    {
    }

    public function __invoke(ValidateAuthorizationCommand $command)
    {
        $this->validator->__invoke($command);
    }
}
