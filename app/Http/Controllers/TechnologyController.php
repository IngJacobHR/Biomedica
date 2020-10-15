<?php

namespace App\Http\Controllers;

use App\Technology;
use App\Http\Requests\TechnologyRequest;
use Illuminate\Http\Request;
use Karriere\PdfMerge\PdfMerge;
use Illuminate\Support\Facades\DB;

class TechnologyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $active=$request->get('active');
        $serie=$request->get('serie');
        $campus=$request->get('campus');
        return view('technology.index',['technologies'=>Technology::active($active)
        ->serie($serie)
        ->campus($campus)
        ->latest()->paginate(15)]);

            //with('technologies'=>Technology::all()]);

    }

    public function create()
    {
        return view('technology.create');
    }

    public function store(TechnologyRequest $request)
    {
        $technology = Technology::create($request->all());
        return redirect()->route('technology.index')->withSuccess("The new equipo with active {$technology->active} was created");
    }

    public function show(Technology $technology)
    {
        return view('technology.show')->with([
            'technology'=>$technology
            ]);
    }

    public function edit(Technology $technology)
    {
        return view('technology.edit')->with([
            'technology'=>$technology
            ]);
    }

    public function update(TechnologyRequest $request, Technology $technology)
    {
        $technology->update($request->all());

        return redirect()->route('technology.index')->withSuccess("The new equipo with active {$technology->active} was edit");
    }

    public function destroy(Technology $technology)
    {
       $technology->delete();
       return redirect()->route('technology.index')->withSuccess("The new equipo with active {$technology->active} was destroy");
    }

    public function adjuntar(Request $request, Technology $technology )
    {
        $files= $request->file_pdf;
        $technology->url_document=$this->cargarDocumento($files, $technology);
        $technology->save();
        return redirect()->route('technology.show', $technology );
    }

    public function cargarDocumento($files, Technology $technology)
    {
        $pdf = new PdfMerge;
        foreach ($files as $key => $files) {
            $pdf->add($files->getPathName());
        }

        $nombre_pdf=$technology->id . '.pdf';
        $pdf->merge(public_path().'/documentos/'.$nombre_pdf);
        return $nombre_pdf;
    }
}
