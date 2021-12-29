<?php

namespace App\Http\Controllers;

use App\Constants\TechnologyRisks;
use App\Constants\TechnologyService;
use App\Http\Controllers\Strategies\TechnologyRisk\TechnologyRiskManager;
use App\Equipment;
use App\Campus;
use App\Technology;
use App\Http\Requests\TechnologyRequest;
use Illuminate\Http\Request;
use Karriere\PdfMerge\PdfMerge;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TechnologyController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index(Request $request, Technology $technology)
    {

        $active=$request->get('active');
        $serie=$request->get('serie');
        $equipment_id=$request->get('equipment_id');
        $campus_id=$request->get('campus_id');
        return view('technology.index',['technologies'=>Technology::active($active)
        ->serie($serie)
        ->equipment_id($equipment_id)
        ->campus_id($campus_id)
        ->latest()->simplepaginate(400),
        'campus_id'=>Campus::pluck('name', 'id'),
        'equipment_id'=>Equipment::pluck('name', 'id')]);
    }

    public function create()
    {

        $technology = new Technology;
        return view('technology.create', [
            'technology'=> $technology,
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
            'risks' => TechnologyRisks::toArray(),
            'service' => TechnologyService::toArray(),
        ]);

    }

    public function store(TechnologyRequest $request)
    {
        $Technology = new Technology();

        $Technology->equipment_id = $request->get('equipment_id');
        $Technology->campus_id = $request->get('campus_id');
        $Technology->location = $request->get('location');
        $Technology->active = $request->get('active');
        $Technology->model = $request->get('model');
        $Technology->mark = $request->get('mark');
        $Technology->serie= $request->get('serie');
        $Technology->risk = $request->get('risk');
        $Technology->date_mant = $request->get('date_mant');
        $Technology->date_cal = $request->get('date_cal');
        $Technology->date_in = $request->get('date_in');
        $Technology->date_warranty = $request->get('date_warranty');
        $Technology->supplier = $request->get('supplier');
        $Technology->value = $request->get('value');
        $Technology->service = $request->get('service');
        $Technology->next_mant = $request->get('date_mant')
            ? $this->setNextMaintenance($request->get('risk'), $request->get('date_mant'))
            : null;
        $Technology->next_cal = $request->get('date_cal')
            ? $this->setNextCal($request->get('date_cal'))
            : null;
        $Technology->save();
        return redirect()->route('technology.index')->withSuccess("Se creó el nuevo equipo con activo {$Technology->active}");
    }

    public function show(Technology $technology)
    {
        return view('technology.show')->with([
            'technology'=>$technology,
            ]);
    }

    public function edit(Technology $technology)
    {
        return view('technology.edit')->with([
            'technology'=>$technology,
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
            ]);
    }

    public function update(TechnologyRequest $request, Technology $technology)
    {
        $technology->next_mant = $request->get('date_mant')
            ? $this->setNextMaintenance($request->get('risk'), $request->get('date_mant'))
            : null;
        $technology->next_cal = $request->get('date_cal')
            ? $this->setNextCal($request->get('date_cal'))
            : null;
        $technology->update($request->all());

        return redirect()->route('technology.index')->withSuccess("El equipo con activo {$technology->active} fue editado");
    }

    public function destroy(Technology $technology)
    {
       $technology->delete();
       return redirect()->route('technology.index')->with('eliminar', 'ok');
       //->withSuccess("The new equipo with active {$technology->active} was destroy");
    }


    public function setNextMaintenance( $risk, $maintenance)
    {
        $riskBehavior = config('risks.' . $risk);

        return (new TechnologyRiskManager(new $riskBehavior['behavior']()))
                ->getNextMaintenance($maintenance);
    }

    public function setNextCal($cal)
    {
        $cal = Carbon::parse($cal);

        return $cal->addDays(365);
    }




}
