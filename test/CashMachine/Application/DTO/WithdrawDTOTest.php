<?php

declare(strict_types = 1);

namespace Tests\CashMachine\Application\DTO;

use Api\CashMachine\Application\DTO\WithdrawDTO;
use PHPUnit\Framework\TestCase;

class WithdrawDTOTest extends TestCase
{

    /**
     * @test
     */
    public function fromArrayMustWork(): void
    {
        $withdrawDTO = WithdrawDTO::fromArray(['value' => '150']);
        $this->assertEquals(150, $withdrawDTO->getWithdrawValue());
    }
}
