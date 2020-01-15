<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Validator;
use App\UserInformation;


class AuthController extends Controller
{
  public function login(Request $request){
    $http = new \GuzzleHttp\Client();

    try{
      $response = $http->post('https://onmyway69.herokuapp.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 61,
            'client_secret' => 'CEzakOEUKew3nlRnhOI20I7ntNdLIjHips0oZgei',
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
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);

      $user_information_id = User::where('email', $request->email)->first();

      $user_information = UserInformation::create([
      'user_id' => $user_information_id->id,
      'first_name' => $request->name,
      'last_name' => $request->lastname,
      'age' => '',
      'sex' => '',
      'phone' => '',
      'address' => '',
      ]);


      // login process again
      $http = new \GuzzleHttp\Client();

      try{
      $response = $http->post('https://onmyway69.herokuapp.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 61,
            'client_secret' => 'CEzakOEUKew3nlRnhOI20I7ntNdLIjHips0oZgei',
            'username' => $request->email,
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
