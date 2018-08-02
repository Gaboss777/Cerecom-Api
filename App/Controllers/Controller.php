<?php 
/**
* This is the main controller class, The controllers should inherit from this class (for custom views) or from \Core\Crud (for simple crud scaffolds)
*/
namespace App\Controllers;
class Controller{
	public function __construct(){
		$this->msg=new \Plasticbrain\FlashMessages\FlashMessages();
		$this->month=isset($_GET['month'])? $_GET['month'] : date('m');
		$this->year=isset($_GET['year'])? $_GET['year'] : date('Y')	;
	}
	
}

?>