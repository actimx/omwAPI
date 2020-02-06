<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "hola mundo";
        $groups = Group::get();
        return response()->json(compact('groups'));
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
        /* $group = new Group();
        $group->user_id = $request->user_id;
        $group->name = $request->name;
        $group->photo = $request->photo;

        $group->save();*/

        //IMAGE
        /* $entrada=$request->all();

        if($archivo=$request->photo('photo')){
            $nombre=$archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $entrada['photo']=$nombre;
        }

        Group::create($entrada);*/
        // if($request->has('photo')){
        //     $file = $request->file('photo');
        //     $name_file = time().$file->getClientOriginalName();
        //     $file->move(public_path().'/images/', $name_file);
        // }
        $group = new Group();
        $group->user_id = $request->user_id;
        $group->name = $request->name;
        $group->photo = $request->photo;

        $group->save();

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Bring back the group information for id

        $group_information = Group::Where('user_id',$id)->get();
        return response()->json(compact('group_information'));
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
     /* $group = Group::findOrFail($id);
      $group->user_id = $request->user_id;
      $group->name = $request->name;
      $group->photo = $request->photo;
      $group->save();*/

      //IMAGE
      /*$entrada = Group::findOrFail($id);
      $entrada=$request->all()->save();

      if($archivo=$request->photo('photo')){
        $path = Storage::disk('public')->put('images', $request->photo('photo'));
        $entrada->fill(['photo'=> asset($path)])->save();*/

       /* $nombre=$archivo->getClientOriginalName();
        $archivo->move('images', $nombre);
        $entrada['photo']=$nombre;
      }
      */
      if($request->hasFile('photo')){
        $file = $request->file('photo');
        $name_file = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name_file);
      }

      $group = Group::findOrFail($id);
      $group->user_id = $request->user_id;
      $group->name = $request->name;
      $group->photo = $name_file;
      $group->save();


      return response()->json([
        'result' => 'success'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
}
