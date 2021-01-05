<?php 
namespace App\Models;

class Account extends \ActiveRecord\Model{
	public function serialize(){
		return $this->to_array();
	}
}



 ?>