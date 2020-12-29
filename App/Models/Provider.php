<?php 
namespace App\Models;

class Provider extends \ActiveRecord\Model{
	static $has_many =[['bills']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>