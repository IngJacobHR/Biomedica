<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\WorkOrders;
use App\User;
use App\Campus;
use App\Equipment;
use App\Failure;
use Illuminate\Http\Request;
use App\Http\Requests\WorkordersRequest;
use App\Http\Requests\EvaluationRequest;
use App\Http\Requests\UpdateWorkordersRequest;
use App\Http\Requests\UpdatesupportRequest;
use App\Http\Requests\WocRequest;
use Illuminate\Queue\Worker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

use function GuzzleHttp\Promise\all;

class WorkordersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(WorkOrders $work)
    {

        return view('workorders.index');

    }

    public function modal($idworkorders)
    {
        $workorders=WorkOrders::find($idworkorders);
        return view('workorders.modal',compact('workorders'));

    }

    public function OT(WorkOrders $work)
    {

        return view('workorders.OT',['workorders'=>WorkOrders::where('status','=','Pendiente')->latest()->paginate(10)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,WorkOrders $work)
    {

        if(Auth::user()->roles == "Manager")
        {
            $status=$request->get('status');
            $campus_id=$request->get('campus_id');
            $description=$request->get('description');
            if ($status == 'Evaluar') {
                return view('workorders.index1',['workorders'=>WorkOrders::description($description)
                ->campus_id($campus_id)
                ->where(function ($q) {
                    $q->where('status','=','Evaluar')->orWhere('status','=','Terminada');})
                ->whereNull('evaluation')
                ->latest()->get(),
                //->simplepaginate(400),
                'campus'=>Campus::pluck('name', 'id'),
                ]);
            }
            elseif ($status == 'Terminada') {
                return view('workorders.index1',['workorders'=>WorkOrders::description($description)
                ->status($status)
                ->campus_id($campus_id)
                ->whereNotNull('evaluation')
                ->latest()->get(),
                //->simplepaginate(400),
                'campus'=>Campus::pluck('name', 'id'),
                ]);

            }
             return view('workorders.index1',['workorders'=>WorkOrders::status($status)
            ->description($description)
            ->status($status)
            ->campus_id($campus_id)
            ->latest()->get(),
            //->simplepaginate(400),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }

        $status=$request->get('status');
        $campus_id=$request->get('campus_id');
        $description=$request->get('description');

        if ($status == 'Evaluar') {

            return view('workorders.index1',['workorders'=>WorkOrders::description($description)
            ->campus_id($campus_id)
            ->where(function ($q) {
                $q->where('status','=','Evaluar')->orWhere('status','=','Terminada');})
            ->whereNull('evaluation')
            ->where('username','=',Auth::id())
            ->latest()->get(),
            //->simplepaginate(400),
            'campus'=>Campus::pluck('name', 'id'),
            ]);
        }
        elseif ($status == 'Terminada') {
            return view('workorders.index1',['workorders'=>WorkOrders::where('username','=',Auth::id())
            ->status($status)
            ->campus_id($campus_id)
            ->description($description)
            ->whereNotNull('evaluation')
            ->latest()->get(),
            //->simplepaginate(400),
            'campus'=>Campus::pluck('name', 'id'),
            ]);

        }

        return view('workorders.index1',['workorders'=>WorkOrders::where('username','=',Auth::id())
        ->status($status)
        ->campus_id($campus_id)
        ->description($description)
        ->latest()->get(),
        //->simplepaginate(400),
        'campus'=>Campus::pluck('name', 'id'),
        ]);
    }

    public function support ()
    {
        return view('workorders.index2',['workorders'=>WorkOrders::where('assigned','=',Auth::user()->name)
        ->where('status', '!=' , 'Terminada')
        ->where('status', '!=' , 'Evaluar')
        ->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $workorders = new WorkOrders;
        return view('workorders.create', [
            'workorders'=> $workorders,
            'failures_id'=>Failure::pluck('name', 'id'),
            'campus_id'=>Campus::pluck('name', 'id'),
            'equipment_id'=>Equipment::pluck('name', 'id'),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkordersRequest $request)
    {
        $username=Auth::id();
        $workorders= WorkOrders::create($request->all());
        $workorders->update([
            'username'=>$username,
        ]);
       return back()->withSuccess("Su orden de trabajo #{$workorders->id} se genero con exito ");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Responsef
     */

    public function edit($idworkorders)
    {
        $workorders=WorkOrders::find($idworkorders);
        $users=User::select("*")->where('roles','=','Admin')->orWhere('roles','=','Manager')->get();
        return view('workorders.edit',compact(['users','workorders']));
    }

    public function execute($idworkorders)
    {
        $workorders=WorkOrders::find($idworkorders);
        return view('workorders.execute',compact('workorders'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkordersRequest $request, $workorders)
    {
        $workorders=WorkOrders::find($workorders);
        $check = "Pendiente";
        if ($request->status="Pendiente")
        {
             $check = "Asignada";
        }
        $workorders->update([
            'assigned' =>$request->assigned,
            'date_calendar'=>$request->date_calendar,
            'status'=>$check,
        ]);

        return redirect()->route('workorders.index')->withSuccess("Se asigno la orden de trabajo numero #{$workorders->id}");

    }


    public function updatesupport(UpdatesupportRequest $request,$workorders)
    {
        $workorders=WorkOrders::find($workorders);

        $workorders->update([
            'date_novelty' =>$request->date_novelty,
            'status'=>$request->status,
            'observation'=>$request->observation,
            'report'=>$request->report,
            ]);

         if($workorders->status=='Terminada' and $workorders->evaluation==NULL)
         {
            $date = Carbon::now();
            $date->toDateTimeString();
            $workorders->update([
                'date_execute' =>$date
            ]);
         }

         if($workorders->status=='Correccion' and $workorders->evaluation=='Mala')
         {

            $check = "Terminada";
            $workorders->update([
                'correction'=>$request->correction,
                'status'=>$check,
            ]);
         }

        return redirect()->route('workorders.support')->withSuccess("Se Ejecuto la O.T. #{$workorders->id}");

    }

    public function evaluation(EvaluationRequest $request,$id)
    {
        $workorders=WorkOrders::find($id);
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
        $work = WorkOrders::select('order',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->groupBy('order')
        ->get();

        $solution = WorkOrders::select('assigned',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('assigned','<>','null')
        ->groupBy('assigned')
        ->get();


        $bryan = WorkOrders::select('status',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('assigned','=','brayan gutierrez')
        ->groupBy('status')
        ->get();

        $juan = WorkOrders::select('status',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('assigned','=','JUAN ESTEBAN JARAMILLO CASTAÑO')
        ->groupBy('status')
        ->get();

        $sedes = DB::table('campuses')
        ->join('work_orders', 'campuses.id', '=', 'work_orders.campus_id')
        ->select('campuses.name', 'work_orders.created_at')
        ->where('work_orders.created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('campuses.name','<>','Odontología Centro')
        ->where('campuses.name','<>','Odontología Norte')
        ->where('campuses.name','<>','Odontología Calasanz')
        ->where('campuses.name','<>','Odontología PAC')
        ->where('campuses.name','<>','Odontología Av.oriental')
        ->select('campuses.name',DB::raw("COUNT('campuses.name') as count"))
        ->groupBy('name')
        ->get();


        $odon = DB::table('campuses')
        ->join('work_orders', 'campuses.id', '=', 'work_orders.campus_id')
        ->select('campuses.name', 'work_orders.created_at')
        ->where('work_orders.created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
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


        $finish = WorkOrders::select('status',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->groupBy('status')
        ->get();

        $evaluation = WorkOrders::select('evaluation',DB::raw("COUNT('id') as count"))
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('status','=','Terminada')
        ->groupBy('evaluation')
        ->get();
        $evaluation[0]['evaluation'] = 'Sin evaluar';

        $times_prog = WorkOrders::select('date_calendar', 'date_execute','order')
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('status','=','Terminada')
        ->where('order','=','Programada')
        ->where('date_novelty','=', NULL)
        ->get();

        $times_urg = WorkOrders::select('id','date_calendar', 'date_execute','order')
        ->where('created_at','>',Carbon::now()->subDays(30)->format('Y-m-d'))
        ->where('status','=','Terminada')
        ->where('order','=','Urgente')
        ->where('date_novelty','=', NULL)
        ->get();

        $cont = 0;
        foreach ($times_prog as $time  ) {
            $date_calendar = Carbon::parse($time->date_calendar);
            $date_execute = Carbon::parse($time->date_execute);
            if ($date_calendar->diffInDays($date_execute, false) > 2){
                $prog [] = 24 * $date_calendar->diffInDays($date_execute, false);
            }else {
                $prog [] = 24;
                $cont +=1;
            }
        }


        foreach ($times_urg as $time  ) {
            $date_calendar = Carbon::parse($time->date_calendar);
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
