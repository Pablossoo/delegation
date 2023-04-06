<?php

declare(strict_types=1);

namespace App;

use App\DTO\DelegationRequest;
use App\Enum\Country;
use App\Factory\DelegationCostFactoryInterface;
use App\Factory\DelegationFactoryInterface;
use App\Repository\DelegationEntityRepository;
use App\ValueObject\DiffDaysDelegation;

final readonly class DelegationFacade
{
    public function __construct(
        private DelegationFactoryInterface $delegationFactory,
        private DelegationEntityRepository $delegationEntityRepository,
        private DelegationCostFactoryInterface $delegationCost
    ) {
    }

    public function createDelegation(DelegationRequest $delegationRequest): void
    {
        $delegation = $this->delegationFactory->create($delegationRequest);
        $this->delegationEntityRepository->save($delegation);
    }

    public function getDelegationsCostByUser(DelegationRequest $delegationRequest): int
    {
        $diffDaysDelegation = new DiffDaysDelegation();
        $costCalculator     = $this->delegationCost->create(
            $diffDaysDelegation->calculateDiffDate($delegationRequest->startDelegation, $delegationRequest->endDelegation)
        );

       return  $costCalculator->getTotalCost($this->getCountryFromValue($delegationRequest->country));
    }

    private function getCountryFromValue(string $value): Country {
        return match ($value) {
            'PL' => Country::PL,
            'DE' => Country::DE,
            'GB' => Country::GB,
            default => throw new \Exception('sad')
        };
    }
}
