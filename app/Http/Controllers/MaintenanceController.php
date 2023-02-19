<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Campus;
use App\Technology;
use Carbon\Carbon;
class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Technology $technology)
    {

        $now = Carbon::now()->format('Y-m-d');


        $programation = $request->get('programation');
        $metrologic = $request->get('metrologic');
        $active=$request->get('active');
        $serie=$request->get('serie');
        $equipment_id=$request->get('equipment_id');
        $campus_id=$request->get('campus_id');

        $indiMant = Technology::select('id')
        ->active($active)
        ->serie($serie)
        ->equipment_id($equipment_id)
        ->campus_id($campus_id)
        ->where('service','=','En servicio')
        ->where('risk','<>','Muy bajo')
        ->count();


        if (empty($metrologic) or empty($programation) ){

            return view('maintenance.index', ['technologies'=>Technology::active($active)
            ->serie($serie)
            ->equipment_id($equipment_id)
            ->campus_id($campus_id)
            ->where('service','=','En servicio')
            ->latest()->simplepaginate(500),
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),'now'=>$now,'maintenance'=>Technology::active($active)
            ->serie($serie)
            ->equipment_id($equipment_id)
            ->campus_id($campus_id)
            ->where('service','=','En servicio')
            ->where('next_mant','<',Carbon::now()->format('Y-m-d'))
            ->count(),'calibration'=>Technology::active($active)
            ->serie($serie)
            ->equipment_id($equipment_id)
            ->campus_id($campus_id)
            ->where('service','=','En servicio')
            ->where('next_cal','<',Carbon::now()->format('Y-m-d'))
            ->count(),'programation'=>$programation,'metrologic'=>$metrologic,
            'indiMant'=>$indiMant]);

        }
        else{
            if ($metrologic == "Calibración"){
                if ($programation == 'Vencidos'){

                    return view('maintenance.index', ['technologies'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('next_cal','<',Carbon::now()->format('Y-m-d'))
                    ->latest()->simplepaginate(500),
                    'campus_id'=>Campus::pluck('name', 'id'),
                    'equipment_id'=>Equipment::pluck('name', 'id'),'now'=>$now,'calibration'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('next_cal','<',Carbon::now()->format('Y-m-d'))
                    ->count(),'programation'=>$programation,'metrologic'=>$metrologic,
                    'indiMant'=>$indiMant]);
                }
                elseif($programation == 'Por vencer'){

                    return view('maintenance.index', ['technologies'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('next_cal','>',Carbon::now()->format('Y-m-d'))
                    ->where('next_cal','<',Carbon::now()->addDays(30)->format('Y-m-d'))
                    ->latest()->simplepaginate(500),
                    'campus_id'=>Campus::pluck('name', 'id'),
                    'equipment_id'=>Equipment::pluck('name', 'id'),'now'=>$now,'calibration'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('next_cal','>',Carbon::now()->format('Y-m-d'))
                    ->where('next_cal','<',Carbon::now()->addDays(30)->format('Y-m-d'))
                    ->count(),'programation'=>$programation,'metrologic'=>$metrologic,
                    'indiMant'=>$indiMant]);

                }
            }
            else if ($metrologic == "Mantenimiento"){
                if ($programation == 'Vencidos'){

                    return view('maintenance.index', ['technologies'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('risk','<>','Muy bajo')
                    ->where('next_mant','<',Carbon::now()->format('Y-m-d'))
                    ->latest()->simplepaginate(500),
                    'campus_id'=>Campus::pluck('name', 'id'),
                    'equipment_id'=>Equipment::pluck('name', 'id'),'now'=>$now,'maintenance'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('next_mant','<',Carbon::now()->format('Y-m-d'))
                    ->count(),'programation'=>$programation,'metrologic'=>$metrologic,
                    'indiMant'=>$indiMant]);

                }
                elseif($programation == 'Por vencer'){

                    return view('maintenance.index', ['technologies'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('risk','<>','Muy bajo')
                    ->where('next_mant','>',Carbon::now()->format('Y-m-d'))
                    ->where('next_mant','<',Carbon::now()->addDays(30)->format('Y-m-d'))
                    ->latest()->simplepaginate(500),
                    'campus_id'=>Campus::pluck('name', 'id'),
                    'equipment_id'=>Equipment::pluck('name', 'id'),'now'=>$now,'maintenance'=>Technology::active($active)
                    ->serie($serie)
                    ->equipment_id($equipment_id)
                    ->campus_id($campus_id)
                    ->where('service','=','En servicio')
                    ->where('next_mant','>',Carbon::now()->format('Y-m-d'))
                    ->where('next_mant','<',Carbon::now()->addDays(30)->format('Y-m-d'))
                    ->count(),'programation'=>$programation,'metrologic'=>$metrologic,
                    'indiMant'=>$indiMant]);

                }
            }

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = strtotime(Carbon::now()->format('Y-m-d'));
        $now1 = Carbon::now()->format('Y-m-d');
        $now1 = Carbon::parse($now1);

        $technology = Technology::select('id','next_mant','next_cal')->get();

        for ($i=0;$i < count($technology);$i++){{
            Technology::where('id','=',$technology[$i]['id'])->update([
                'day_mant'=> $now1 -> diffInDays($technology[$i]['next_mant'],false),
                'day_cal'=> $now1 -> diffInDays($technology[$i]['next_cal'],false)
            ]);
        }}
        $active=$request->get('active');
        $serie=$request->get('serie');
        $equipment_id=$request->get('equipment_id');
        $campus_id=$request->get('campus_id');
        return view('maintenance.index', ['technologies'=>Technology::active($active)
        ->serie($serie)
        ->equipment_id($equipment_id)
        ->campus_id($campus_id)
        ->where('service','=','En servicio')
        ->latest()->simplepaginate(500),
        'campus_id'=>Campus::pluck('name', 'id'),
        'equipment_id'=>Equipment::pluck('name', 'id'),'now'=>$now,'maintenance'=>Technology::active($active)
        ->serie($serie)
        ->equipment_id($equipment_id)
        ->campus_id($campus_id)
        ->where('service','=','En servicio')
        ->where('next_mant','<',Carbon::now()->format('Y-m-d'))
        ->count(),'calibration'=>Technology::active($active)
        ->serie($serie)
        ->equipment_id($equipment_id)
        ->campus_id($campus_id)
        ->where('service','=','En servicio')
        ->where('next_cal','<',Carbon::now()->format('Y-m-d'))
        ->count()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
