<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventInformation;

class EventInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $event_informations = EventInformation::get();
      return response()->json(compact('event_informations'));
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
      $event_information = new EventInformation();
      $event_information->event_id = $request->event_id;
      $event_information->place_name = $request->place_name;
      $event_information->place_address = $request->place_address;
      $event_information->place_city = $request->place_city;
      $event_information->place_state = $request->place_state;
      $event_information->place_zip_code = $request->place_zip_code;
      $event_information->place_country = $request->place_country;
      $event_information->place_phone = $request->place_phone;
      $event_information->organizers = $request->organizers;
      $event_information->event_start_date = $request->event_start_date;
      $event_information->event_end_date = $request->event_end_date;
      $event_information->event_start_time = $request->event_start_time;
      $event_information->event_end_time = $request->event_end_time;

      $event_information->save();

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
      $event_information = EventInformation::findOrFail($id);
      $event_information->event_id = $request->event_id;
      $event_information->place_name = $request->place_name;
      $event_information->place_address = $request->place_address;
      $event_information->place_city = $request->place_city;
      $event_information->place_state = $request->place_state;
      $event_information->place_zip_code = $request->place_zip_code;
      $event_information->place_country = $request->place_country;
      $event_information->place_phone = $request->place_phone;
      $event_information->organizers = $request->organizers;
      $event_information->event_start_date = $request->event_start_date;
      $event_information->event_end_date = $request->event_end_date;
      $event_information->event_start_time = $request->event_start_time;
      $event_information->event_end_time = $request->event_end_time;

      $event_information->save();

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
      $event_information = EventInformation::findOrFail($id);
      $event_information->delete();

      return response()->json([
        'result' => 'success'
      ]);
    }
}
