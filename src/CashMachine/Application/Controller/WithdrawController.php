<?php

declare(strict_types = 1);

namespace Api\CashMachine\Application\Controller;

use Api\CashMachine\Application\DTO\AvailableNotesDTO;
use Api\CashMachine\Application\DTO\WithdrawDTO;
use Api\CashMachine\Application\Presenter\NotesDeliveryFormatter;
use Api\CashMachine\Domain\Service\WithdrawValue;
use Psr\Container\ContainerInterface;

class WithdrawController
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $args
     * @return array
     * @throws \Throwable
     */
    public function getWithdraw(array $args): array
    {
        try {
            $withdrawDTO = WithdrawDTO::fromArray($args);
            $availableNotesDTO = AvailableNotesDTO::fromArray($this->container->get('notes'));
            $withdrawService = $this->container->get(WithdrawValue::class);

            $withdrawNotes = $withdrawService->withdraw($withdrawDTO, $availableNotesDTO);
            $notesDeliveryFormated = NotesDeliveryFormatter::makeDeliveryNotes($withdrawNotes);
            return $notesDeliveryFormated;
        } catch (\InvalidArgumentException $error) {
            throw new \InvalidArgumentException($error->getMessage());
        } catch (\RuntimeException $error) {
            throw new \RuntimeException($error->getMessage());
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
