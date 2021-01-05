<?php 
namespace App\Controllers;
use \Core\View;
use \App\Models\Login;
use \Firebase\JWT\JWT;
class loginsController extends Controller{
	static $model = '\App\Models\Login';

	public function create(){
		$login = new Login($this->payload);
		$login->password = password_hash($login->password,PASSWORD_DEFAULT);

		if($login->save()){
			$this->response(['errors'=>false,'data'=>$login->to_array()]);
		}
		else{
			$this->response(['errors'=>true,'data'=>"Error al crear el usuario"]);
		}
	}

	public function login(){
		$account = \App\Models\Account::find_by_username($this->payload['username']);
		if($account){
			if(password_verify($this->payload['password'],$account->password)){
				$issuedat_claim = time();
				$expire_claim = $issuedat_claim + 60*120;
				$jwt = $this->setAuthToken($account);
				$this->response([
					"message"=>"Login Successful",
					"jwt"=>$jwt,
					"user"=>$account->username,
					"expireAt"=>$expire_claim,
				]);
			}

			else{
				http_response_code(401);
				$this->response(['errors'=>false,'data'=>"Contraseña Incorrecta"]);
			}
		}
		else{
			http_response_code(401);
			$this->response(['errors'=>false,'data'=>"Usuario no encontrado"]);
		}
	}


	private function setAuthToken($user){
		$secret_key = "YOUR_SECRET_KEY";
		$issuer_claim = "cobranzas.inversionescerecom.com";
		$audience_claim = "World";
		$issuedat_claim = time();
		$notbefore_claim = $issuedat_claim+0;
		$expire_claim = $issuedat_claim + 60*120;
		$token = [
			"iss" => $issuer_claim,
			"aud" => $audience_claim,
			"iat" => $issuedat_claim,
			"nbf" => $notbefore_claim,
			"exp" => $expire_claim,
			"data" => [
				"id"=>$user->id,
				"user" => $user->user,
				"role"=>$user->role,
				"user_id"=>$user->user_id
			]
		];
		$jwt=JWT::encode($token,$secret_key);
		return $jwt;
	}
}


?>