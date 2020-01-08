<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

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
      $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string',
      ]);
      
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);
        return $response->$user;
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
    return Auth()->user();
  }
}
