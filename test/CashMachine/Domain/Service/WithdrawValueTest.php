<?php

namespace Tests\CacheMachine\Domain\Service;

use Api\CashMachine\Application\DTO\AvailableNotesDTO;
use Api\CashMachine\Application\DTO\WithdrawDTO;
use Api\CashMachine\Domain\Service\WithdrawValue;
use PHPUnit\Framework\TestCase;

class WithdrawValueTest extends TestCase
{
    /**
     * @var
     */
    private $withdrawDTO;

    private $availableNotesDTO;

    public function setUp(): void
    {
        $this->withdrawDTO = $this->getMockBuilder(WithdrawDTO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->availableNotesDTO = $this->getMockBuilder(AvailableNotesDTO::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function getWithdrawValueMustWork(): void
    {
        $this->withdrawDTO->method('getWithdrawValue')->willReturn('180');
        $this->availableNotesDTO->method('getAvailableNotes')->willReturn([100,50,20,10]);

        $withdraw = (new WithdrawValue())->withdraw($this->withdrawDTO, $this->availableNotesDTO);
        $expected = [
            '100' => 1,
            '50' => 1,
            '20' => 1,
            '10' => 1
        ];
        $this->assertEquals($expected, $withdraw);
    }

    /**
     * @test
     */
    public function getEmptyWithdrawValueReturnEmptyArray(): void
    {
        $this->withdrawDTO->method('getWithdrawValue')->willReturn(null);
        $withdraw = (new WithdrawValue())->withdraw($this->withdrawDTO, $this->availableNotesDTO);

        $this->assertEquals([], $withdraw);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function withdrawMustThrowExceptionWhenNegativeValueIsProvided(): void
    {
        $this->withdrawDTO->method('getWithdrawValue')->willReturn(-300);
        (new WithdrawValue())->withdraw($this->withdrawDTO, $this->availableNotesDTO);
    }

    /**
     * @test
     * @expectedException \Api\CashMachine\Domain\Exception\NoteUnavailableException
     */
    public function withdrawThrowExceptionWhenUnavailableValueIsProvided(): void
    {
        $this->withdrawDTO->method('getWithdrawValue')->willReturn(173);
        $this->availableNotesDTO->method('getAvailableNotes')->willReturn([100,50,20,10]);
        (new WithdrawValue())->withdraw($this->withdrawDTO, $this->availableNotesDTO);
    }
}
