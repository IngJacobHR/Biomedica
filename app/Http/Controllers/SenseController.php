<?php

namespace App\Http\Controllers;
use App\Sense;
use App\Sensor;
use Illuminate\Http\Request;
use App\Http\Requests\Maximini;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class SenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $sensors = Sense::select('id','name','campus','location','description','val','type')->get();


        return view('crud.crudSensor')->with('sensors',$sensors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.crudCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sensors = new Sense();

        $sensors->name = $request->get('name');
        $sensors->location = $request->get('location');
        $sensors->description = $request->get('description');

        $sensors->save();

        return redirect('/sensors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sense $sensor)
    {
        $rawdata = Sense::select('val', 'date')->get();
        return view('charts.historicChart',compact('rawdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sensor = Sense::find($id);
        return view('crud.crudEdit')->with('sensor',$sensor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(Maximini $request, $name)
    {
        Sense::where('name', $name)
        ->update(['campus' => $request->get('campus'),'location' => $request->get('location'),'type' => $request->get('type'),'max' => $request->get('max'),'min' => $request->get('min'),'email2' => $request->get('email2'),'email1' => $request->get('email1'),'description' => $request->get('description')]);
        return redirect('/sensors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)

    {   $id=Sense::where('name',$name)->get();

        $id=$id[0]->id;
        Sensor::where('senses_id',$id)->delete();
        Sense::where('name',$name)->delete();


        return redirect('/sensors');
    }


}
