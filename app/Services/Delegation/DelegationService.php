<?php


namespace App\Services\Delegation;


use App\DTO\StoreDelegationDTO;
use App\Models\Delegation;
use App\Repositories\Delegation\DelegationRepository;
use App\Repositories\User\UserRepository;
use App\ValueObjects\ID;
use Illuminate\Support\Collection;

final class DelegationService
{
    private DelegationRepository $delegationRepository;
    private UserRepository $userRepository;
    private DelegationCostService $delegationCostService;

    public function __construct(
        DelegationRepository $delegationRepository,
        UserRepository $userRepository,
        DelegationCostService $delegationCostService
    ) {
        $this->delegationRepository = $delegationRepository;
        $this->userRepository = $userRepository;
        $this->delegationCostService = $delegationCostService;
    }

    public function storeDelegation(StoreDelegationDTO $delegationData): void
    {
        if (!$this->datesCorrect($delegationData->startDate(), $delegationData->endDate())) {
            throw new \Exception('Start of delegation must happen before its end');
        }

        $delegations = $this->listUserDelegations($delegationData->userId());

        if (!$this->isDateSlotAvailable($delegationData, $delegations)) {
            throw new \Exception('Delegation time is already scheduled');
        }

        $cost = $this->delegationCostService
            ->calculateCost($delegationData);


        $this->delegationRepository
            ->store(
                new Delegation(
                    $delegationData->userId(),
                    $delegationData->startDate(),
                    $delegationData->endDate(),
                    strtoupper($delegationData->countryCode()),
                    $cost
                ));
    }

    public function listUserDelegations(ID $userId): Collection
    {
        return $this->delegationRepository
            ->findForUser(
                $this->userRepository
                    ->findOne($userId)
            );
    }

    private function isDateSlotAvailable(StoreDelegationDTO $delegationData, Collection $delegations): bool
    {
        /** @var Delegation $delegation */
        foreach ($delegations as $delegation) {

            // If the starting date is between already scheduled time delegation cannot be created
            if ($delegation->start() <= $delegationData->startDate()
                && $delegation->end() >= $delegationData->startDate()) {
                return false;
            }
            if ($delegation->start() <= $delegationData->endDate()
                && $delegation->end() >= $delegationData->endDate()) {
                return false;
            }

            return true;
        }
    }

    private function datesCorrect(\DateTimeImmutable $start, \DateTimeImmutable $end)
    {
        return $end->diff($start)->invert === 1;
    }
}
