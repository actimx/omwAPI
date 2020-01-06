<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

Class JwtAuth{
	public $key;

	public function __construct(){
		$this->key = '0n-My-W4y-17122019*//'
	}

	public function signup($email, $password, $getToken=null){

		$user = User::where(
				array(
					'email' => $email,
					'password' => $password
				))->first();

		$signup = false;
		
		if(is_object($user)){
			$signup = true;
		}

		if($signup){
			//Generar el token y devolverlo
			$token = array(
				'sub' => $user->id,
				'email' => $user->email,
				'name' => $user->name,
				'surname' => $user->surname,
				'iat' => time(),
				'exp' => time() + (7 * 24 * 60 * 60) 
			);

			$jwt = JWT::encode($token, $this->key, array('HS256'));
			$decoded = JWT::decode($token, $this->key, array('HS256'));

			if(!is_null($getToken)){
				return $jwt;
			}else{
				return $decoded;
			}


		}else{
			//Devolver un error
			return array('status' => 'error', 'message' => 'Login ha fallado !!');
		}
	}


	public function checkToken($jwt, $getIdentity = false){
		$auth = false;

		try{
			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
		}catch(\UnexpectedValueException $e){
			$auth = false;
		}catch(\DomainException $e){
			$auth = false;
		}

		if(is_object($decoded) && isset($decoded->sub)){
			$auth = true;
		}else{
			$auth = false;
		}

		if($getIdentity){
			return $decoded;
		}



		return $auth;

	}
}
