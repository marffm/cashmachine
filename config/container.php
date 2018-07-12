<?php

use Api\CashMachine\Domain\Service\WithdrawValue;

$container = $app->getContainer();

$container['notes'] = require __DIR__ . './notes.php';

//Services
$container[WithdrawValue::class] = function () {
    return new WithdrawValue();
};