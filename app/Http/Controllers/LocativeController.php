<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Locative;
use App\Locativefail;
use App\Locativegroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LocativeRequest;
use App\Http\Requests\UpdateWorkordersRequest;
use App\Http\Requests\UpdatesupportRequest;
use Illuminate\Support\Facades\Auth;


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
        $autenti=Auth::id();
        $locative= Locative::create($request->all());
        $locative->update([
            'autenti'=>$autenti,
        ]);
       return back()->withSuccess("Su orden de trabajo #{$locative->id} se genero con exito ");
    }

    public function OT(Locative $locative)
    { 
        
        return view('locative.OT',['locative'=>Locative::where('status','=','Pendiente')->latest()->paginate(10)]);
    
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

        $locative=locative::all()->where('autenti','=',Auth::id());
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
        return view('locative.support',['locative'=>Locative::where('assigned','=',Auth::user()->name)
        ->where('status', '!=' , 'Terminada')
        ->latest()->paginate(10)]);
    }

    public function execute($idlocative)
    {   
        $locative=Locative::find($idlocative);
        return view('locative.execute',compact('locative'));    
    }

    public function updatesupport(UpdatesupportRequest $request,$locative)
    {   
        $locative=Locative::find($locative);
        $locative->update([
            'date_execute' =>$request->date_execute,
            'status'=>$request->status,
            'observation'=>$request->observation,
            'evaluatión'=>$request->evaluatión,
        ]);
       
        return redirect()->route('locative.support')->withSuccess("Se Ejecuto la O.T. #{$locative->id}");
        
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
