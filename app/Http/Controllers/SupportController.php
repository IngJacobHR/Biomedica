<?php

namespace App\Http\Controllers;

use App\Support;
use App\Campus;
use App\Items_1;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $items_id=$request->get('items_id');
        $campus_id=$request->get('campus_id');
        $state=$request->get('state');


        return view('support.index', ['supports'=>Support::items_id($items_id)
        ->campus_id($campus_id)
        ->state($state)
        ->get(),
        'campus_id'=>Campus::pluck('name', 'id'),
        'items_id'=>Items_1::pluck('name', 'id'),
        ]);
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
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {

        return view('support.edit')->with([
            'support'=>$support,
            'campus_id'=>Campus::pluck('name', 'id'),
            'items_id'=>Items_1::pluck('name', 'id'),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {

        $support->update($request->all());

        return redirect()->route('support.index')->withSuccess("El equipo fue editado");
    }

    public function execute(Support $support)
    {

        $success = "Ejecutado";
        $support->update([
            'state' => $success
        ]);

        return redirect()->route('support.index')->withSuccess("Mantenimiento ejecutado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $support = Support::find($id);
        $support -> delete();
        return redirect()->route('support.index')->with('eliminar', 'ok');
    }
}
