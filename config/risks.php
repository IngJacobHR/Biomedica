<?php

use App\Constants\TechnologyRisks;
use App\Http\Controllers\Strategies\TechnologyRisk\Behaviors\HighRiskBehavior;
use App\Http\Controllers\Strategies\TechnologyRisk\Behaviors\LowRiskBehavior;
use App\Http\Controllers\Strategies\TechnologyRisk\Behaviors\ModerateRiskBehavior;

return [
    TechnologyRisks::High => ['behavior' => HighRiskBehavior::class],
    TechnologyRisks::Moderate => ['behavior' => ModerateRiskBehavior::class],
    TechnologyRisks::Low=> ['behavior' => LowRiskBehavior::class],
];
