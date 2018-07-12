<?php
declare(strict_types=1);

namespace Api\CashMachine\Domain\Exception;

class NoteUnavailableException extends \RuntimeException
{

    /**
     * @return NoteUnavailableException
     */
    public static function fromUnavailableNote(): self
    {
        return new self('Unavailable notes for this withdraw.');
    }
}
