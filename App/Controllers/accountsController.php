<?php 
namespace App\Controllers;
use \Core\View;

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
}


 ?>