<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Campus;
use App\Technology;

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

        $dia=$request->date_mant;
        $dia1=strtotime($dia."+ 45 day");
        $dia1=date("d-m-y",$dia1);

        $technology->update([
            'next_mant'=>$dia1
        ]);

        $active=$request->get('active');
        $serie=$request->get('serie');
        $equipment_id=$request->get('equipment_id');
        $campus_id=$request->get('campus_id');
        return view('maintenance.index', ['technologies'=>Technology::active($active)
        ->serie($serie)
        ->equipment_id($equipment_id)
        ->campus_id($campus_id)
        ->latest()->simplepaginate(150),
        'campus_id'=>Campus::pluck('name', 'id'),
        'equipment_id'=>Equipment::pluck('name', 'id')]);
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
        //
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
