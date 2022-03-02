<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Campus;
use App\Locative;
use App\Locativefail;
use App\Locativegroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LocativeRequest;
use App\Http\Requests\UpdatelocativeRequest;
use App\Http\Requests\UpdateWorkordersRequest;
use App\Http\Requests\UpdatesupportRequest;
use App\Http\Requests\Maxmin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EvaluationRequest;
use Illuminate\Support\Facades\DB;


class LocativeController extends Controller
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
        $locative = new Locative;
        return view('locative.create', [
            'locative'=> $locative,
            'locativefails_id'=>Locativefail::pluck('name', 'id'),
            'campus_id'=>Campus::pluck('name', 'id'),
            'locativegroups_id'=>Locativegroup::pluck('name', 'id'),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocativeRequest $request)
    {
        $username=Auth::id();

        //$locative= Locative::create($request->all());
        $locative= Locative::create([
            'campus_id' =>$request->get('campus_id'),
            'location'=>$request->get('location'),
            'active'=>$request->get('report_type'),
            'locativegroups_id'=>$request->get('locativegroups_id'),
            'locativefails_id'=>$request->get('locativefails_id'),
            'description'=>$request->get('description'),
            'order'=>$request->get('order'),
        ]);
        $locative->update([
            'username'=>$username,
        ]);

       return back()->withSuccess("Su orden de trabajo #{$locative->id} se genero con exito ");
    }

    public function OT(Locative $locative, Request $request)
    {
        $order_id=$request->get('order');
        $campus_id=$request->get('campus_id');
        $fails_id=$request->get('fails_id');
        return view('locative.OT',['locative'=>Locative::campus_id($campus_id)
        ->locativefails_id($fails_id)
        ->order($order_id)
        ->where('status','=','Pendiente')
        ->latest()->get(),
        'campus'=>Campus::pluck('name', 'id'),
        'fails'=>Locativefail::pluck('name', 'id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if(Auth::user()->roles == "S.Admin")
        {
            $status=$request->get('status');
            $campus_id=$request->get('campus_id');
            $description=$request->get('description');
            if ($status == 'Evaluar') {
                $status = 'Terminada';
                return view('locative.show',['locative'=>locative::status($status)
                ->description($description)
                ->campus_id($campus_id)
                ->whereNull('Evaluation')
                ->latest()->get(),
                //->latest()->simplepaginate(150),
                'campus'=>Campus::pluck('name', 'id'),
                ]);
            }
            elseif ($status == 'Terminada') {
                return view('locative.show',['locative'=>locative::status($status)
                ->description($description)
                ->campus_id($campus_id)
                ->whereNotNull('Evaluation')
                ->latest()->get(),
                //->latest()->simplepaginate(150),
                'campus'=>Campus::pluck('name', 'id'),
                ]);
            }
            return view('locative.show',['locative'=>locative::status($status)
            ->description($description)
            ->campus_id($campus_id)
            ->latest()->get(),
            //->latest()->simplepaginate(150),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }

        $status=$request->get('status');
        $campus_id=$request->get('campus_id');
        $description=$request->get('description');
        if ($status == 'Evaluar') {
            $status = 'Terminada';
            return view('locative.show',['locative'=>locative::where('username','=',Auth::id())
            ->status($status)
            ->description($description)
            ->campus_id($campus_id)
            ->whereNull('Evaluation')
            ->latest()->get(),
            //->latest()->simplepaginate(150),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }
        elseif ($status == 'Terminada') {
            return view('locative.show',['locative'=>locative::where('username','=',Auth::id())
            ->status($status)
            ->description($description)
            ->campus_id($campus_id)
            ->whereNotNull('Evaluation')
            ->latest()->get(),
            //->latest()->simplepaginate(150),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }
        return view('locative.show',['locative'=>locative::where('username','=',Auth::id())
        ->status($status)
        ->campus_id($campus_id)
        ->description($description)
        ->latest()->simplepaginate(150),
        'campus'=>Campus::pluck('name', 'id'),
        ]);
    }

    public function report($idlocative)
    {
        $locative=locative::find($idlocative);
        return view('locative.report',compact('locative'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idlocative)
    {
        $locative=Locative::find($idlocative);
        $users=User::all()->where('roles','=','S.Admin');
        return view('locative.edit',compact(['users','locative']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkordersRequest $request, $locative)
    {
        $locative=Locative::find( $locative);
        $check = "Pendiente";
        if ($request->status="Pendiente")
        {
             $check = "Asignada";
        }
        $locative->update([
            'assigned' =>$request->assigned,
            'date_calendar'=>$request->date_calendar,
            'status'=>$check,
        ]);

        return redirect()->route('locative.OT')->withSuccess("Se asigno la orden de trabajo numero #{$locative->id}");
    }

    public function support (Request $request)
    {   $campus_id=$request->get('campus_id');
        $initialDate=$request->get('initialDate');
        $finalDate=$request->get('finalDate');
        if (empty($initialDate) || empty($finalDate)) {
            return view('locative.support',['locative'=>locative::campus_id($campus_id)
            ->where('status', '!=' , 'Terminada')
            ->latest()->get(),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }
        else{
            return view('locative.support',['locative'=>locative::campus_id($campus_id)
            ->where('status', '!=' , 'Terminada')
            ->where('created_at','>=',$initialDate)
            ->where('created_at','<=',$finalDate)
            ->latest()->simplepaginate(400),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }
    }
    //where('status', '!=' , 'Terminada')

    public function execute($idlocative)
    {
        $locative=Locative::find($idlocative);
        return view('locative.execute',compact('locative'));
    }

    public function updatesupport(UpdatesupportRequest $request,$locative)
    {
        $locative=Locative::find($locative);
        $locative->update([
            'date_novelty' =>$request->date_novelty,
            'status'=>$request->status,
            'observation'=>$request->observation,
            'report'=>$request->report,
        ]);

        if($locative->status=='Terminada' and $locative->evaluation==NULL)
        {
           $date = Carbon::now();
           $date->toDateTimeString();
           $locative->update([
               'date_execute' =>$date
           ]);
        }

        if($locative->status=='Correccion' and $locative->evaluation=='Mala')
        {

           $check = "Terminada";
           $locative->update([
               'correction'=>$request->correction,
               'status'=>$check,
           ]);
        }

        return redirect()->route('locative.support')->withSuccess("Se Ejecuto la O.T. #{$locative->id}");

    }

    public function evaluation(EvaluationRequest $request,$id)
    {
        $workorders=Locative::find($id);
        $check = "Terminada";
        $date = Carbon::now();
        if($request->evaluation=="Mala")
        {
            $check = "Rechazada";
        }
        $workorders->update([
            'evaluation' =>$request->evaluation,
            'commentary'=>$request->commentary,
            'date_evaluation'=>$date,
            'status'=>$check,
        ]);
        return back()->withSuccess("Gracias por evaluar el servicio");
    }

    public function indicators()
    {
        $work = Locative::select('order',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->groupBy('order')
        ->get();

        $solution = Locative::select('assigned',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('assigned','<>','null')
        ->groupBy('assigned')
        ->get();

        $sedes = DB::table('campuses')
        ->join('locatives', 'campuses.id', '=', 'locatives.campus_id')
        ->select('campuses.name', 'locatives.created_at')
        ->where('locatives.created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('campuses.name','<>','Odontología Centro')
        ->where('campuses.name','<>','Odontología Norte')
        ->where('campuses.name','<>','Odontología Calasanz')
        ->where('campuses.name','<>','Odontología PAC')
        ->where('campuses.name','<>','Odontología Av.oriental')
        ->select('campuses.name',DB::raw("COUNT('campuses.name') as count"))
        ->groupBy('name')
        ->get();


        $odon = DB::table('campuses')
        ->join('locatives', 'campuses.id', '=', 'locatives.campus_id')
        ->select('campuses.name', 'locatives.created_at')
        ->where('locatives.created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('campuses.name','<>','Argentina')
        ->where('campuses.name','<>','Av.oriental')
        ->where('campuses.name','<>','Calasanz')
        ->where('campuses.name','<>','Calasanz alterna')
        ->where('campuses.name','<>','Centro')
        ->where('campuses.name','<>','Centro alterna')
        ->where('campuses.name','<>','Especialistas')
        ->where('campuses.name','<>','Estadio')
        ->where('campuses.name','<>','IPS Virtual')
        ->where('campuses.name','<>','Laboratorio')
        ->where('campuses.name','<>','Norte')
        ->where('campuses.name','<>','Norte alterna')
        ->where('campuses.name','<>','PAC')
        ->where('campuses.name','<>','Prosalco')
        ->where('campuses.name','<>','Sofasa')
        ->select('campuses.name',DB::raw("COUNT('campuses.name') as count"))
        ->groupBy('name')
        ->get();

        $finish = Locative::select('status',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->groupBy('status')
        ->get();

        $evaluation = Locative::select('evaluation',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('status','=','Terminada')
        ->groupBy('evaluation')
        ->get();

        $evaluation[0]['evaluation'] = 'Sin evaluar';

        $times_prog = Locative::select('created_at', 'date_execute','order')
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('status','=','Terminada')
        ->where('order','=','Programada')
        ->where('date_novelty','=', NULL)
        ->get();

        $times_urg = Locative::select('created_at', 'date_execute','order')
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('status','=','Terminada')
        ->where('order','=','Urgente')
        ->where('date_novelty','=', NULL)
        ->get();

        $cont = 0;
        foreach ($times_prog as $time  ) {
            $date_calendar = Carbon::parse($time->created_at);
            $date_execute = Carbon::parse($time->date_execute);
            if ($date_calendar->diffInDays($date_execute, false) > 8){
                $prog [] = 24 * $date_calendar->diffInDays($date_execute, false);
            }else {
                $prog [] = 24;
                $cont +=1;
            }
        }

        foreach ($times_urg as $time  ) {
            $date_calendar = Carbon::parse($time->created_at);
            $date_execute = Carbon::parse($time->date_execute);
            if ($date_calendar->diffInDays($date_execute, false) > 1){
                $urg [] = 24 * $date_calendar->diffInDays($date_execute, false);
            }else {
                $urg [] = 24;
                $cont +=1;
            }

        }

        $total = count($prog) + count($urg);

        $total = number_format((($cont/$total)*100),2);
        $prog =number_format((array_sum($prog))/count($prog),2);
        $urg = number_format((array_sum($urg))/count($urg),2);


        return view(('workorders.indicators'),compact('work','solution','sedes', 'odon', 'finish', 'evaluation','prog','urg','total'));
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
