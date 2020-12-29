<?php 
namespace App\Controllers;
use \Core\View;
class employeesController extends crudController{
	static $model = '\App\Models\Employee';

	public function deleteAll(){

		foreach($this as $u){
			$result=[];
			$employee=\App\Models\Employee::find([$u]);
			if($employee->delete()){
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