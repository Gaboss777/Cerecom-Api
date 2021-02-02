<?php 
namespace App\Models;

class Profile extends \ActiveRecord\Model{
	public function serialize(){
		return $this->to_array();
	}


}



 ?>