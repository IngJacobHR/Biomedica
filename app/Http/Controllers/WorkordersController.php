<?php

namespace App\Http\Controllers;

use App\WorkOrders;
use App\User;
use App\Campus;
use App\Equipment;
use App\Failure;
use Illuminate\Http\Request;
use App\Http\Requests\WorkordersRequest;
use App\Http\Requests\UpdateWorkordersRequest;
use App\Http\Requests\UpdatesupportRequest;
use App\Http\Requests\WocRequest;
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
        
        return view('workorders.index',['workorders'=>WorkOrders::where('status','=','Pendiente')->latest()->paginate(10)]);
    
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
        $autenti=Auth::id();
        $workorders= WorkOrders::create($request->all());
        $workorders->update([
            'autenti'=>$autenti,
        ]);
       return back()->withSuccess("Su orden de trabajo #{$workorders->id} se genero con exito ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        if(Auth::user()->roles == "Manager")
        {
            $workorders=WorkOrders::all();
            return view('workorders.index1', compact('workorders'));
        }

        $workorders=WorkOrders::all()->where('autenti','=',Auth::id());
        return view('workorders.index1', compact('workorders'));
        
       
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
        $users=User::all()->where('roles','=','Admin');
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
                'date_execute' =>$request->date_execute,
                'status'=>$request->status,
                'observation'=>$request->observation,
                'evaluatión'=>$request->evaluatión,
            ]);
        

       
       
        return redirect()->route('workorders.support')->withSuccess("Se Ejecuto la O.T. #{$workorders->id}");
        
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
