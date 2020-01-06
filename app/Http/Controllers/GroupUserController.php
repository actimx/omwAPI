<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupUser;

class GroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $group_users = GroupUser::get();
      return response()->json(compact('group_users'));
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
      $group_user = new GroupUser();
      $group_user->group_id = $request->group_id;
      $group_user->user_name = $request->user_name;

      $group_user->save();

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
        //
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
      $group_user = GroupUser::findOrFail($id);
      $group_user->group_id = $request->group_id;
      $group_user->user_name = $request->user_name;

      $group_user->save();

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
      $group_user = GroupUser::findOrFail($id);
      $group_user->delete();

      return response()->json([
        'result' => 'success'
      ]);
    }
}
