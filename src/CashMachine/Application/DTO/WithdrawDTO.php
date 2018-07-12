<?php

declare(strict_types=1);

namespace Api\CashMachine\Application\DTO;

use Api\CashMachine\Domain\DTO\WithdrawDTOInterface;

class WithdrawDTO implements WithdrawDTOInterface
{

    /**
     * @var null|int
     */
    private $value;

    /**
     * WithdrawDTO constructor.
     * @param null|string $value
     */
    public function __construct(?string $value)
    {
        $this->value = (int)$value;
    }

    /**
     * @return null|int
     */
    public function getWithdrawValue(): ?int
    {
        return $this->value;
    }

    /**
     * Named constructor to return an instance of WithdrawDTO
     *
     * @param array $params
     * @return WithdrawDTO
     */
    public static function fromArray(array $params): self
    {
        return new self(
            $params['value'] ?? null
        );
    }
}
