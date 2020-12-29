<?php 
namespace App\Models;

class Employee extends \ActiveRecord\Model{
	static $has_many=[['salaries']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>