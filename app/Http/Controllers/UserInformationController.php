<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInformation;

class UserInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_informations = UserInformation::get();
      return response()->json(compact('user_informations'));
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
      $user_information = new UserInformation();
      $user_information->user_id = $request->user_id;
      $user_information->first_name = $request->first_name;
      $user_information->last_name = $request->last_name;
      $user_information->age = $request->age;
      $user_information->sex = $request->sex;
      $user_information->phone = $request->phone;
      $user_information->address = $request->address;

      $user_information->save();

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
      $user_information = UserInformation::findOrFail($id);
      $user_information->user_id = $request->user_id;
      $user_information->first_name = $request->first_name;
      $user_information->last_name = $request->last_name;
      $user_information->age = $request->age;
      $user_information->sex = $request->sex;
      $user_information->phone = $request->phone;
      $user_information->address = $request->address;

      $user_information->save();

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
      $user_information = UserInformation::findOrFail($id);
      $user_information->delete();

      return response()->json([
        'result' => 'success'
      ]);
    }
}
