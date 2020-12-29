<?php 
namespace App\Models;

class Role extends \ActiveRecord\Model{
	static $has_many=[['accounts']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>