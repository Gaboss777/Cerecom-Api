<?php 
namespace App\Controllers;
use \Core\View;
use \App\Models\Login;
class loginsController extends crudController{
	static $model = '\App\Models\Login';

	public function create(){
		$account = new Login($this->payload);
		$account->password = password_hash($account->password,PASSWORD_DEFAULT);

		if($account->save()){
			$this->response(['errors'=>false,'data'=>$account->to_array()]);
		}
		else{
			$this->response(['errors'=>true,'data'=>"Error al crear el usuario"]);
		}
    }

}


?>