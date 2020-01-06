<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $invitations = Invitation::get();
      return response()->json(compact('invitations'));
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
      $invitations = new Invitation();
      $invitations->user_id = $request->user_id;
      $invitations->event_id = $request->event_id;
      $invitations->confirmation_status = $request->confirmation_status;
      $invitations->message = $request->message;

      $invitations->save();

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
      $invitations = Invitation::findOrFail($id);
      $invitations->user_id = $request->user_id;
      $invitations->event_id = $request->event_id;
      $invitations->confirmation_status = $request->confirmation_status;
      $invitations->message = $request->message;

      $invitations->save();

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
      $invitations = Invitation::findOrFail($id);
      $invitations->delete();

      return response()->json([
        'result' => 'success'
      ]);
    }
}
