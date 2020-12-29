<?php 
namespace App\Models;

class Payment extends \ActiveRecord\Model{
	static $belongs_to =[['user']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>