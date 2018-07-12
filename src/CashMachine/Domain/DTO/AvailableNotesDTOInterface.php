<?php

namespace Api\CashMachine\Domain\DTO;

interface AvailableNotesDTOInterface
{

    public function getAvailableNotes(): ?array;
}
