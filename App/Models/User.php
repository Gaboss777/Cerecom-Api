<?php 
namespace App\Models;

class User extends \ActiveRecord\Model{
	static $has_many = [['payments']];
	public function serialize(){
		return $this->to_array();
	}
}



 ?>