<?php

namespace Api\CashMachine\Application\Presenter;

class OutputFormatter
{

    public static function formatReturnJson(array $output): array
    {
        return [
            'data' => $output
        ];
    }
}
