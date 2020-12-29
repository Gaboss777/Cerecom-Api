<?php 
namespace App\Models;

class Bill extends \ActiveRecord\Model{
	static $belongs_to =[['provider']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>