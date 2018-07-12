<?php

declare(strict_types=1);

namespace Api\CashMachine\Domain\Exception;

class NegativeNumberException extends \InvalidArgumentException
{

    /**
     * @param int $value
     * @return NegativeNumberException
     */
    public static function fromNegativeValue(int $value): self
    {
        return new self(sprintf('Invalid value $"%s".00 passed.', $value));
    }
}
