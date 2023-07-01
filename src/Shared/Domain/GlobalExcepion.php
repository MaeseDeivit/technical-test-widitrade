<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

use Exception;

abstract class GlobalExcepion extends Exception
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    abstract public function errorCode(): int;

    abstract protected function errorMessage(): string;

    abstract protected function errorStatusCode(): int;
}
