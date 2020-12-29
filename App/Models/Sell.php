<?php 
namespace App\Models;

class Sell extends \ActiveRecord\Model{
	static $belongs_to =[['seller']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>