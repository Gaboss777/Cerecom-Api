<?php 
namespace App\Controllers;
use \App\Models\User;
class usersController extends crudController{
	static $model='\App\Models\User';
	public function deleteAll(){

		foreach($this as $u){
			$result=[];
			$user=User::find([$u]);
			if($user->delete()){
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