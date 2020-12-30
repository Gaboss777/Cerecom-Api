<?php 
namespace App\Models;

class Login extends \ActiveRecord\Model{
	public function serialize(){
		return $this->to_array();
	}


}



 ?>