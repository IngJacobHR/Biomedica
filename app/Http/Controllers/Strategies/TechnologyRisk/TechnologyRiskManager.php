<?php

namespace App\Http\Controllers\Strategies\TechnologyRisk;

class TechnologyRiskManager
{
    /**
     * @var EquipmentRiskContract
     */
    private $behavior;

    public function __construct(TechnologyRiskContract $behavior)
    {
        $this->behavior = $behavior;
    }

    public function getNextMaintenance(string $maintenance): string
    {
        return $this->behavior->getNextMaintenance($maintenance);
    }
}
