<?php

namespace App\Http\Controllers\Strategies\TechnologyRisk;

interface TechnologyRiskContract
{
    public function getNextMaintenance(string $maintenance): string;
}
