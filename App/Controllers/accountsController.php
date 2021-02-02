<?php 
namespace App\Controllers;
use \Core\View;
use \App\Models\Account;
use \Firebase\JWT\JWT;
class accountsController extends crudController{
	static $model = '\App\Models\Account';

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

	public function update($id){
		$account = Account::find([$id]);
		$updateAccount = $this->payload;
		$updateAccount['password'] = password_hash($updateAccount['password'],PASSWORD_DEFAULT);

		if($account->update_attributes($updateAccount)){
			$this->response(['errors'=>false,'data'=>$account->serialize()]);
		} 
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}
	}

}


?>