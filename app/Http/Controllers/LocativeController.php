<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EvaluationRequest;


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
        $locative= Locative::create($request->all());
        $locative->update([
            'username'=>$username,
        ]);
       return back()->withSuccess("Su orden de trabajo #{$locative->id} se genero con exito ");
    }

    public function OT(Locative $locative)
    {

        return view('locative.OT',['locative'=>Locative::where('status','=','Pendiente')->latest()->paginate(100)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::user()->roles == "S.Admin")
        {
            $locative=Locative::all();
            return view('locative.show', compact('locative'));
        }

        $locative=locative::all()->where('username','=',Auth::id());
        return view('locative.show', compact('locative'));

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

    public function support ()
    {
        return view('locative.support',['locative'=>Locative::all()
        ->where('status', '!=' , 'Terminada')
        ->where('status', '!=' , 'Pendiente')

    ]);
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
