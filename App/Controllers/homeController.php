<?php 
namespace App\Controllers;
use \Core\View;
class homeController extends Controller{
	public function index(){
		View::set('title',"MICRO FW");
		View::render('home/index');
	}
}


 ?>