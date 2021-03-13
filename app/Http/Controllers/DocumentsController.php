<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Documents;
use App\Technology;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Document;

//use Illuminate\Support\Facades\Auth;
//use League\CommonMark\Block\Element\Document;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Technology $technology)
    {
        $files=Documents::where('technology_id', $technology->id)->latest()->get();
        return view('documents.index', compact('files'));

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
    public function store(Request $request,Technology $technology)
    {

        $max_size = (int)ini_get('upload_max_filesiza')*10240;
        $files=$request->file('files');
        $technology_id =$technology->id;

        foreach ($files as $file){
            $fileName=Str::slug($file->getClientOriginalName());
            if(Storage::putFileAs('/public/'.$technology_id.'/',$file, $fileName)){
            Documents::create([
                'name'=>$fileName,
                'technology_id'=> $technology_id
            ]);
            }
        }

        Alert::success('Success Title', 'Success Message');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('documents.show')->with([
            'technology'=>$technology
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $file= Documents::whereId($id)->firstOrFail();

        //unlink(public_path('storage',$file->id));

        $file->delete();
        return back();


    }
}
