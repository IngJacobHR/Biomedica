<?php

namespace App\Http\Controllers;

use App\Technology;
use App\Campus;
use App\Equipment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campus $campus)

    {   $now = strtotime(Carbon::now()->format('Y-m-d'));
        $programation = 1;
        $metrologic = 2;


        return view('maintenance.index', [
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
            'campus'=>$campus,
            'technologies'=>$campus->technology()
            ->with('campus')
            ->where('service','<>','Fuera de servicio')
            ->latest()->simplepaginate(150),
            'now'=>$now,
            'maintenance'=>$campus->technology()
            ->with('campus')
            ->where('service','<>','Fuera de servicio')
            ->where('next_mant','<',Carbon::now()->format('Y-m-d'))
            ->count(),
            'calibration'=>$campus->technology()
            ->with('campus')
            ->where('service','<>','Fuera de servicio')
            ->where('next_cal','<',Carbon::now()->format('Y-m-d'))
            ->count(),'programation'=>$programation,'metrologic'=>$metrologic,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campus $campus)
    {

        return view('technology.index', [
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
            'campus'=>$campus,
            'technologies'=>$campus->technology()->with('campus')->latest()->simplepaginate(20)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($campus)
    {

        return view('technology.index', [
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
            'technologies'=>Technology::where('service','=',$campus)->latest()->simplepaginate(200)

        ]);
        //dd($campus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $equipment_id= $request->equipment_id;

        //$equipment=Equipment::find($equipment_id);
        //dd($equipment);
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
