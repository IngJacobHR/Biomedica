<?php

namespace App\Http\Controllers;

use App\Sensor;
use App\Sense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Filter;

class SensorController extends Controller
{
        public function id($id)
    {
        $dateTomorrow = new Carbon('tomorrow');
        $dateTomorrow = $dateTomorrow->format('Y-m-d');


        $dateYesterday = new Carbon('now');
        $dateYesterday = $dateYesterday->format('Y-m-d');



        $rawdata = Sensor::select('val', 'date')
        ->where('senses_id','=',$id)
        ->where('date','>',$dateYesterday)
        ->get();

        $dataType = Sense::select('name', 'type', 'min', 'max')
        ->where('id','=',$id)
        ->get();


        return view('charts.dailyChart',compact('rawdata','id','dataType'));
    }

    public function historic($id)
    {
        $rawdata = Sensor::select('val', 'date')
        ->where('senses_id','=',$id)
        ->where('date','>',Carbon::now()->subDays(7)->format('Y-m-d'))
        ->get();

        $dataType = Sense::select('name', 'type', 'id', 'min', 'max' )
        ->where('id','=',$id)
        ->get();

        return view('charts.historicChart',compact('rawdata','id','dataType'));
    }

    public function filter(Filter $request, $id)
    {       $rawdata = Sensor::select('val', 'date')
            ->where('date', '>=', $request->initialDate)
            ->where('date', '<=', $request->finalDate)
            ->where('senses_id', '=', $id)
            ->get();

            $dataType = Sense::select('name', 'type', 'min', 'max')
            ->where('id','=',$id)
            ->get();

            return view('charts.historicChart', compact('rawdata','id','dataType'));
    }

    public function filterDaily(Filter $request, $id)
    {
            $rawdata = Sensor::select('val', 'date')
            ->where('date', '>=', $request->initialDate)
            ->where('date', '<=', $request->finalDate)
            ->where('senses_id', '=', $id)
            ->get();

            $dataType = Sense::select('name', 'type', 'min', 'max')
            ->where('id','=',$id)
            ->get();

            return view('charts.dailyChart', compact('rawdata','id','dataType'));

    }

    public function filterEvent(Filter $request, $id)
    {
            $rawdata = Sensor::select('id','val', 'date', 'comment')
            ->where('date', '>=', $request->initialDate)
            ->where('date', '<=', $request->finalDate)
            ->where('event', '=', 1)
            ->where('senses_id', '=', $id)
            ->orderBy('date','desc')
            ->simplepaginate(30);

            $dataType = Sense::select('name', 'type', 'min', 'max')
            ->where('id','=',$id)
            ->get();

            return view('charts.eventChart', compact('rawdata','id','dataType'));

    }
    public function event($id)
    {
        $dateTomorrow = new Carbon('tomorrow');
        $dateTomorrow = $dateTomorrow->format('Y-m-d');

        $dateYesterday = new Carbon('now');
        $dateYesterday = $dateYesterday->format('Y-m-d');

        $rawdata = Sensor::select('id','val', 'date', 'comment')
        ->where('event','=',1)
        ->where('senses_id','=',$id)
        ->orderBy('date','desc')
        ->simplepaginate(30);
        $dataType = Sense::select('name', 'type', 'min', 'max')
        ->where('id','=',$id)
        ->get();

        return view('charts.eventChart',compact('rawdata', 'id', 'dataType'));
    }

    public function eventEdit($id,$name,Sensor $sensor)
    {
        $rawdata = Sensor::select('comment','updated_at')
        ->where('id','=',$id)
        ->get();
        $dataType = Sense::select('name')
        ->where('name','=',$name)
        ->get();
        if (empty($rawdata[0]->comment)) {
            return view('charts.eventEdit',compact('id','rawdata','dataType'));
        } else {
            return view('charts.eventComment',compact('id','rawdata','dataType'));
        }
    }

    public function eventEditupdate(Request $request,sensor $id)
    {
        Sensor::where('id','=',$id->id)->update(['comment' => $request->get('comment')]);
        $id = Sense::select('id')
        ->where('id','=', $id->senses_id)
        ->get();

        return redirect()->route('event',[$id[0]->id]);
    }
}

