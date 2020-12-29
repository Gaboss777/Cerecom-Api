<?php 
namespace App\Controllers;
use \Core\View;
class homeController extends Controller{
	public function index(){
		$clients = \App\Models\Client::all();
		print_r($clients);
		die();
		$this->response($response);
	}
}


 ?>