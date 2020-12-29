<?php 
namespace App\Models;

class Seller extends \ActiveRecord\Model{
	static $has_many =[['sells']];
	public function serialize(){
		return $this->to_array();
	}


}



 ?>