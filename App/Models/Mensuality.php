<?php 
namespace App\Models;

class Mensuality extends \ActiveRecord\Model{
	public function serialize(){
		return $this->to_array();
	}
}



 ?>