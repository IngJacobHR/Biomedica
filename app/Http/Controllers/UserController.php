<?php

namespace App\Http\Controllers;

use App\Constants\UserRoles;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUsersRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','manager']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all()->where('roles','!=','Manager');
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idUser)
    {
        $usuario=User::find ($idUser);
        return view('users.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $idUser)
    {
        $usuario = User::find($idUser);
        $check = false;
        if ($request->enabled_user)
        {
             $check = true;
        }
        $usuario->update([
            'name' =>$request->name,
            'roles'=>$request->roles,
            'enabled_user' => $check,
        ]);

        return redirect()->route('users.index')->withSuccess("El Usuario numero {$usuario->id} fue editado");;
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
