<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

abstract class GlobalInfrastructureExcepion extends GlobalExcepion
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }
}
