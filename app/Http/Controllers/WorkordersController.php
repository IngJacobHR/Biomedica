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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
            $description=$request->get('description');
            return view('workorders.index1',['workorders'=>WorkOrders::status($status)
            ->description($description)
            ->latest()->simplepaginate(150),
            ]);
        }

        $status=$request->get('status');
        $description=$request->get('description');
        return view('workorders.index1',['workorders'=>WorkOrders::where('username','=',Auth::id())
        ->status($status)
        ->description($description)
        ->latest()->simplepaginate(150),
        ]);
    }

    public function support ()
    {
        return view('workorders.index2',['workorders'=>WorkOrders::where('assigned','=',Auth::user()->name)
        ->where('status', '!=' , 'Terminada')
        ->latest()->paginate(10)]);
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
