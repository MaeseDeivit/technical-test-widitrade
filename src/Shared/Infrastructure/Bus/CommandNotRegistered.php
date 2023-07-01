<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Bus;

use Exception;
use Throwable;

final class CommandNotRegistered extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Command not registered" : $message;
        parent::__construct($message, $code, $previous);
    }
}
