<?php

declare(strict_types=1);

namespace Src\Authorization\Domain\Model\ValueObjects;

use Src\Shared\Domain\ValueObjects\StringValueObject;
use Src\Authorization\Domain\Exceptions\TokenNotValidException;

final class AuthorizationToken extends StringValueObject
{
    public function __construct(private string $value)
    {
        parent::__construct($value);
    }
    public function validateToken(): void
    {
        if (!$this->isValidParenthesisOrder()) {
            throw new TokenNotValidException($this->value);
        }
    }
    private function isValidParenthesisOrder(): bool
    {
        $character = strlen($this->value);
        $stack = array();
        for ($i = 0; $i < $character; $i++) {
            switch ($this->value[$i]) {
                case '{':
                    array_push($stack, 0);
                    break;
                case '}':
                    if (array_pop($stack) !== 0)
                        return false;
                    break;
                case '[':
                    array_push($stack, 1);
                    break;
                case ']':
                    if (array_pop($stack) !== 1)
                        return false;
                    break;
                case '(':
                    array_push($stack, 2);
                    break;
                case ')':
                    if (array_pop($stack) !== 2)
                        return false;
                    break;
                default:
                    return false;
                    break;
            }
        }
        return (empty($stack));
    }
}
