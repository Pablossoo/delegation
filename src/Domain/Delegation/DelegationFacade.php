<?php

declare(strict_types=1);

namespace App\Domain\Delegation;

use App\Domain\Common\Enum\Country;
use App\Domain\Delegation\DTO\DelegationRequest;
use App\Domain\Delegation\Factory\DelegationCostFactoryInterface;
use App\Domain\Delegation\Factory\DelegationFactoryInterface;
use App\Domain\Delegation\ValueObject\DiffDaysDelegation;
use App\Infrastructure\ORM\DelegationEntityRepository;
use App\Mapper\MapCountryToCurrency;

final readonly class DelegationFacade
{
    public function __construct(
        private DelegationFactoryInterface $delegationFactory,
        private DelegationEntityRepository $delegationEntityRepository,
        private DelegationCostFactoryInterface $delegationCost,
        private MapCountryToCurrency $countryToCurrency
    ) {
    }

    public function createDelegation(DelegationRequest $delegationRequest): void
    {
        $delegation = $this->delegationFactory->create($delegationRequest);
        $this->delegationEntityRepository->save($delegation);
    }

    public function getDelegationsByUser(int $user): array
    {
        $diffDaysDelegation = new DiffDaysDelegation();

        $delegations = $this->delegationEntityRepository->getDelegationsByUser($user);

        $response = [];
        /** @var Delegation $delegation */
        foreach ($delegations as $delegation) {
            $totalCostDelegation = 0;
            $costCalculator      = $this->delegationCost->create(
                $diffDaysDelegation->calculateDiffDate(
                    $delegation->getStartDelegation(),
                    $delegation->getEndDelegation()
                )
            );

            $totalCostDelegation += $costCalculator->getTotalCost(
                $this->getCountryFromValue($delegation->getCountry())
            );

            $result = [
                'start' => $delegation->getStartDelegation()
                    ->format('Y-m-d H:i:s'),
                'end' => $delegation->getEndDelegation()
                    ->format('Y-m-d H:i:s'),
                'country'    => $delegation->getCountry(),
                'amount_due' => $totalCostDelegation,
                'currency'   => $this->countryToCurrency->map($delegation->getCountry()),
            ];

            $response[] = $result;
        }

        return $response;
    }

    private function getCountryFromValue(string $value): Country
    {
        return match ($value) {
            'PL'    => Country::PL,
            'DE'    => Country::DE,
            'GB'    => Country::GB,
            default => throw new \Exception('country not found')
        };
    }
}
