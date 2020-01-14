<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Validator;

class AuthController extends Controller
{
  public function login(Request $request){
    $http = new \GuzzleHttp\Client();

    try{
      $response = $http->post('https://onmyway69.herokuapp.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'RT9Mim3zlvZ4T1MWimUVq3nNOu2Zp6aR1baGOkVJ',
            //'client_id' => 11,
            //'client_secret' => 'KPkc18zX3lu3sWrotRcHCFISNcB7FmXWkAE7Tz6X',
            'username' => $request->username,
            'password' => $request->password,
            
        ]
      ]);
      return $response->getBody();
    } catch(\GuzzleHttp\Exception\BadResponseException $e){
      if($e->getCode() === 400){
        return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
      } else if($e->getCode() === 401){
        return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
      }

      return response()->json($e->getResponse()->getBody(true));
    }
  }

  public function register(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string',
        'c_password' => 'required|same:password',
    ]);
    if($validator->fails()) {
        return response()->json([
            'result' => "error",
            'errors' => $validator->errors()->first()
        ], 400);
    }
      
      $user = User::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);


      // login process again
      $http = new \GuzzleHttp\Client();

      try{
      $response = $http->post('https://onmyway69.herokuapp.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'RT9Mim3zlvZ4T1MWimUVq3nNOu2Zp6aR1baGOkVJ',
            'username' => $request->username,
            'password' => $request->password,
        ]
      ]);

      return $response->getBody();
    } catch(\GuzzleHttp\Exception\BadResponseException $e){
      if($e->getCode() === 400){
        return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
      } else if($e->getCode() === 401){
        return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
      }

      return response()->json('Something went wrong on the server.', $e->getCode());
    }
  }

  public function getUser(){
    return "Hola marco";
    //return Auth()->user();
  }
}
