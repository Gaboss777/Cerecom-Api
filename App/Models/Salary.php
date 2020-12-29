<?php 
namespace App\Models;

class Salary extends \ActiveRecord\Model{
	static $belong_to =[['employie']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>