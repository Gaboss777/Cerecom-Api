<?php 
namespace App\Controllers;
use \App\Models\Payment;
class reportsController extends crudController{
	public function index(){
		$result=[];
		$payments= Payment::all();
		foreach($payments as $payment){
			$p=$payment->to_array();
			$p['client']=$payment->user->name;
			$result[]=$p;
		}
		$this->response(['errors'=>false,'data'=>$result]);
	}

}

?>