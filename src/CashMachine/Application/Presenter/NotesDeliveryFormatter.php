<?php

namespace Api\CashMachine\Application\Presenter;

class NotesDeliveryFormatter
{

    /**
     * Format return of notes
     * @param array $notes
     * @return array
     */
    public static function makeDeliveryNotes(array $notes): array
    {
        $response = [];
        foreach ($notes as $key => $value) {
            if ($value === 0) {
                continue;
            }
            while ($value > 0) {
                $response[] = number_format($key, 2);
                $value--;
            }
        }
        return $response;
    }
}
