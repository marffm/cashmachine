<?php

namespace Tests\CashMachine\Application\DTO;

use Api\CashMachine\Application\DTO\AvailableNotesDTO;
use PHPUnit\Framework\TestCase;

class AvailableNotesDTOTest extends TestCase
{
    /**
     * @test
     */
    public function availableNotesMustWork(): void
    {
        $notes = [100, 50, '20', 10];
        $notesAvailableDTO = AvailableNotesDTO::fromArray($notes);

        $this->assertEquals([100, 50, 20, 10], $notesAvailableDTO->getAvailableNotes());
    }

    /**
     * @test
     */
    public function availableNotesMustWorkIgnoringString(): void
    {
        $notes = [100, 50, '20', 'test'];
        $notesAvailableDTO = AvailableNotesDTO::fromArray($notes);

        $this->assertEquals([100, 50, 20], $notesAvailableDTO->getAvailableNotes());
    }
}
