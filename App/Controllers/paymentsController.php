<?php 
namespace App\Controllers;
use \Core\View;
use \App\Models\Payment;
class paymentsController extends crudController{
	static $model = '\App\Models\Payment';
	public function create(){
		$payment = new Payment($this->payload);
		if($payment->save()){
			$this->response(['errors'=>false,'data'=>$payment->user->to_array(['include'=>'payments'])]);
		}
		else{
			http_response_code(400);
			$this->response(['errors'=>true,'data'=>'No se pudo cargar este pago']);
		}
	}

}


 ?>