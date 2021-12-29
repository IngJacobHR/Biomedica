<?php

namespace App\Http\Controllers\Strategies\TechnologyRisk\Behaviors;

use App\Http\Controllers\Strategies\TechnologyRisk\TechnologyRiskContract;
use Carbon\Carbon;

class ModerateRiskBehavior implements TechnologyRiskContract
{
    private const NEXT_MAINTENANCE_IN_DAYS = 182;

    public function getNextMaintenance(string $maintenance): string
    {
        $maintenance = Carbon::parse($maintenance);

        return $maintenance->addDays(self::NEXT_MAINTENANCE_IN_DAYS);
    }
}
