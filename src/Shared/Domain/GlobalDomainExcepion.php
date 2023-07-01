<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

abstract class GlobalDomainExcepion extends GlobalExcepion
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }
}
