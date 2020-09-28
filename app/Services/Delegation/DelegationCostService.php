<?php


namespace App\Services\Delegation;


use App\DTO\StoreDelegationDTO;
use App\ValueObjects\Cost;
use Carbon\Carbon;
use Carbon\CarbonInterface;

final class DelegationCostService
{
    private const DAILY_HOUR_REQUIREMENT = 8;

    private const DAILY_RATES_MATRIX = [
        'pl' => ['units' => 10, 'currency' => 'pln'],
        'de' => ['units' => 50, 'currency' => 'pln'],
        'gb' => ['units' => 75, 'currency' => 'pln']
    ];

    public function calculateCost(StoreDelegationDTO $delegationData): Cost
    {
        $paidDays = 0;

        $startDate = new Carbon($delegationData->startDate());

        $endOfStartDay = (clone $startDate)->endOfDay();

        if ($startDate->diffInRealHours($endOfStartDay) >= self::DAILY_HOUR_REQUIREMENT && $startDate->isWeekday()) {
            ++$paidDays;
        }

        $endDate = new Carbon($delegationData->endDate());

        if ($endDate->diffInRealHours((clone $endDate)->startOfDay()) >= self::DAILY_HOUR_REQUIREMENT && $endDate->isWeekday()) {
            ++$paidDays;
        }

        $delegationLengthInDays = $endDate->diffInWeekdays($startDate);

        // edges of the range already handled
        if ($delegationLengthInDays >= 3) {
            $paidDays += $delegationLengthInDays - 2;
        }

        if (!strtolower($delegationData->countryCode())) {
            throw new \Exception('Country unsupported');
        }

        $rates = self::DAILY_RATES_MATRIX[strtolower($delegationData->countryCode())];

        $costUnits = $paidDays > 7
            ? $paidDays * $rates['units'] + (($paidDays - 7) * $rates['units'])
            : $paidDays * $rates['units'];

        return new Cost(strtoupper($rates['currency']), $costUnits);
    }
}
