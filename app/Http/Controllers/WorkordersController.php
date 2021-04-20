<?php

namespace App\Http\Controllers;

use App\WorkOrders;
use App\Woc;
use App\User;
use App\Campus;
use App\Equipment;
use App\Failure;
use Illuminate\Http\Request;
use App\Http\Requests\WorkordersRequest;
use App\Http\Requests\UpdateWorkordersRequest;
use App\Http\Requests\WocRequest;

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

    public function index()
    {
        return view('workorders.index',['workorders'=>WorkOrders::where('status','=','Pendiente')->latest()->paginate(10)]);
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
       $workorders= WorkOrders::create($request->all());
       return back()->withSuccess("Su orden de trabajo #{$workorders->id} se genero con exito ");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('workorders.index1',['workorders'=>WorkOrders::all()]);
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
