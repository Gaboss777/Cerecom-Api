<?php 
namespace App\Models;

class Account extends \ActiveRecord\Model{
	static $belongs_to=[['role']];
	public function serialize(){
		return $this->to_array();
	}
}



 ?>