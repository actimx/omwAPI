<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
  Route::get('/user', 'AuthController@getUser');

       Route::resources([
  'events' => 'EventController',
  'event_information' => 'EventInformationController',
  'groups' => 'GroupController',
  'group_user' => 'GroupUserController',
  'invitations' => 'InvitationController',
  'user_information' => 'UserInformationController',
]);
//   Route::get('/users-information/{id}', 'UserController@getUserInformation');
//   Route::post('/users-information', 'UserController@createUserInformation');
//   Route::put('/users-information/{id}', 'UserController@updateUserInformation');
//   Route::delete('/users-information/{id}', 'UserController@deleteUserInformation');

});

// Route::resources([
//   'events' => 'EventController',
//   'event_information' => 'EventInformationController',
//   'groups' => 'GroupController',
//   'group_user' => 'GroupUserController',
//   'invitations' => 'InvitationController',
//   'user_information' => 'UserInformationController',
// ]);
Route::post('/auth/register', 'AuthController@register');
Route::post('/auth/login', 'AuthController@login');
