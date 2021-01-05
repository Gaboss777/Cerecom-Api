<?php 
namespace App\Controllers;
use \Core\View;
class employeesController extends crudController{
	static $model = '\App\Models\Employee';

	public function deleteAll(){
		
		$ids = $this->payload;
		foreach($ids as $id){
			$employee = \App\Models\Employee::find([$id]);
			$employee->delete();
		}
		$this->response(['errors'=>false,'data'=>"Deleted Successfully"]);
	}
}


 ?>