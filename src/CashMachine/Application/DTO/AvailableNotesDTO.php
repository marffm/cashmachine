<?php

namespace Api\CashMachine\Application\DTO;

use Api\CashMachine\Domain\DTO\AvailableNotesDTOInterface;

class AvailableNotesDTO implements AvailableNotesDTOInterface
{

    /**
     * @var array|null
     */
    private $notes;

    /**
     * AvailableNotesDTO constructor.
     * @param array|null $notes
     */
    public function __construct(?array $notes)
    {
        $this->notes = $this->formatNotes($notes);
    }

    /**
     * @return array|null
     */
    public function getAvailableNotes(): ?array
    {
        return $this->notes;
    }

    /**
     * @param array|null $notes
     * @return array|null
     */
    private function formatNotes(?array $notes): ?array
    {
        if (null === $notes) {
            return null;
        }
        $formatedNote = null;

        foreach ($notes as $note) {
            if (! \is_int($note) && ! \is_numeric($note)) {
                continue;
            }
            $formatedNote[] = (int)$note;
        }
        return $formatedNote;
    }

    /**
     * @param array $params
     * @return AvailableNotesDTO
     */
    public static function fromArray(array $params): self
    {
        return new self($params);
    }
}
