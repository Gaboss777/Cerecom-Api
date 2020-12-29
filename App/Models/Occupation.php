<?php 
namespace App\Models;

class Occupation extends \ActiveRecord\Model{
	
	public function serialize(){
		return $this->to_array();
	}


}



 ?>