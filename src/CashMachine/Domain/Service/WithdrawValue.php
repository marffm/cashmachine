<?php

declare(strict_types=1);

namespace Api\CashMachine\Domain\Service;

use Api\CashMachine\Domain\DTO\AvailableNotesDTOInterface;
use Api\CashMachine\Domain\DTO\WithdrawDTOInterface;
use Api\CashMachine\Domain\Exception\NegativeNumberException;
use Api\CashMachine\Domain\Exception\NoteUnavailableException;

class WithdrawValue
{

    /**
     * @param WithdrawDTOInterface $withdrawDTO
     * @param AvailableNotesDTOInterface $availableNotesDTO
     * @return array
     */
    public function withdraw(WithdrawDTOInterface $withdrawDTO, AvailableNotesDTOInterface $availableNotesDTO): array
    {
        if (null === $withdrawDTO->getWithdrawValue() || $withdrawDTO->getWithdrawValue() === 0) {
            return [];
        }

        if ($withdrawDTO->getWithdrawValue() < 0) {
            throw NegativeNumberException::fromNegativeValue($withdrawDTO->getWithdrawValue());
        }

        $availableNotesArray = $availableNotesDTO->getAvailableNotes();
        if (null === $availableNotesArray) {
            throw NoteUnavailableException::fromUnavailableNote();
        }
        $withdrawInt = $withdrawDTO->getWithdrawValue();

        $this->checkValidValueProvided($withdrawInt, $availableNotesArray);

        return $this->withdrawNotes($withdrawInt, $availableNotesArray);
    }

    /**
     * @param int $withdrawInt
     * @param array $availableNotesArray
     */
    private function checkValidValueProvided(int $withdrawInt, array $availableNotesArray): void
    {
        sort($availableNotesArray);
        if (($withdrawInt % $availableNotesArray[0]) !== 0) {
            throw NoteUnavailableException::fromUnavailableNote();
        }
    }

    /**
     * @param int $withdrawInt
     * @param array $availableNotesArray
     * @return array
     */
    private function withdrawNotes(int $withdrawInt, array $availableNotesArray): array
    {
        rsort($availableNotesArray);
        $withdrawNotes = [];

        foreach ($availableNotesArray as $note) {
            $quantityNotes = intdiv($withdrawInt, $note);
            $withdrawNotes[$note] = $quantityNotes;
            $withdrawInt -= ($quantityNotes * $note);
        }

        return $withdrawNotes;
    }
}
