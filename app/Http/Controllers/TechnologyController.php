<?php

namespace App\Http\Controllers;

use App\Constants\TechnologyRisks;
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
        $this->middleware('auth');
    }
    public function index(Request $request, Technology $technology)
    {

        $active=$request->get('active');
        $serie=$request->get('serie');
        return view('technology.index',['technologies'=>Technology::active($active)
        ->serie($serie)
        ->with('campus')
        ->latest()->paginate(15)]);
    }

    public function create()
    {

        $technology = new Technology;
        return view('technology.create', [
            'technology'=> $technology,
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
            'risks' => TechnologyRisks::toArray(),
        ]);

    }

    public function store(TechnologyRequest $request)
    {
        //$technology = Technology::create($request->all());

        $Technology = new Technology();
        $Technology->name = $request->get('name');
        $Technology->risk = $request->get('risk');
        $Technology->date_mant = $request->get('date_mant');
        $Technology->date_cal = $request->get('date_cal');
        $Technology->next_maint = $request->get('date_mant')
            ? $this->setNextMaintenance($request->get('risk'), $request->get('date_mant'))
            : null;
        $Technology->save();

        return redirect()->route('Technologys.index');
        //return redirect()->route('technology.index')->withSuccess("Se creó el nuevo equipo con activo {$technology->active}");
    }

    public function show(Technology $technology)
    {
        return view('technology.show')->with([
            'technology'=>$technology
            ]);
    }

    public function edit(Technology $technology)
    {
        return view('technology.edit')->with([
            'technology'=>$technology,
            'campus_id'=>Campus::pluck('name', 'id'),
            'Technology_id'=>Technology::pluck('name', 'id'),
            ]);
    }

    public function update(TechnologyRequest $request, Technology $technology)
    {

        $technology->update($request->all());
        return redirect()->route('technology.index')->withSuccess("El equipo con activo {$technology->active} fue editado");
    }

    public function destroy(Technology $technology)
    {
       $technology->delete();
       return redirect()->route('technology.index')->withSuccess("The new equipo with active {$technology->active} was destroy");
    }

    public function adjuntar(Request $request, Technology $technology )
    {
        $files= $request->file_pdf;
        $technology->url_document=$this->cargarDocumento($files, $technology);
        $technology->save();
        return redirect()->route('technology.show', $technology );
    }

    public function cargarDocumento($files, Technology $technology)
    {
        $pdf = new PdfMerge;
        foreach ($files as $key => $files) {
            $pdf->add($files->getPathName());
        }

        $nombre_pdf=$technology->id . '.pdf';
        $pdf->merge(public_path().'/documentos/'.$nombre_pdf);
        return $nombre_pdf;
    }

    private function setNextMaintenance( $risk, $maintenance)
    {
        $riskBehavior = config('risks.' . $risk);

        return (new TechnologyRiskManager(new $riskBehavior['behavior']()))
            ->getNextMaintenance($maintenance);
    }

}
