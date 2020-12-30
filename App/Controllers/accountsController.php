<?php 
namespace App\Controllers;
use \Core\View;
use \App\Models\Account;
use \Firebase\JWT\JWT;
class accountsController extends crudController{
	static $model = '\App\Models\Account';
	public function deleteAll(){
		foreach($this as $u){
			$result=[];
			$account=\App\Models\Account::find([$u]);
			if($account->delete()){
				$result[]='x';
				continue;
			}
			else{
				$this->response(['message'=>'Hay un peo']);
			}
			$this->response(['message'=>'Usuarios eliminados con exito']);
		}
	}

	public function create(){
		$account = new Account($this->payload);
		$account->password = password_hash($account->password,PASSWORD_DEFAULT);

		if($account->save()){
			$this->response(['errors'=>false,'data'=>$account->to_array()]);
		}
		else{
			$this->response(['errors'=>true,'data'=>"Error al crear el usuario"]);
		}
	}

	public function login(){
		$account = Account::find_by_username($this->payload['username']);
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
		$issuer_claim = "agent.megabrokerslatam.co";
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
				"firstname" => $user->firstname,
				"firstname" => $user->lastname,
				"role"=>$user->role,
			]
		];
		$jwt=JWT::encode($token,$secret_key);
		return $jwt;
	}
}


?>