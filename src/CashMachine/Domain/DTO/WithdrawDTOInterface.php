<?php

namespace Api\CashMachine\Domain\DTO;

interface WithdrawDTOInterface
{

    public function getWithdrawValue(): ?int;
}
