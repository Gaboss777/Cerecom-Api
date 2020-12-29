<?php 
namespace App\Controllers;
use \Core\View;
class billsController extends Controller{

	public function create(){
		$bill = new \App\Models\Bill($this->payload);
		if($bill->save()){
			$this->response(['errors'=>false,'data'=>$bill->to_array()]);
		}
		else{
			http_response_code(400);
			$this->response(['errors'=>false,'data'=>"No se pudo crear el Pago"]);
		}
	}

	public function index(){
		$result=[];
		$bills = \App\Models\Bill::all();
		foreach($bills as $bill){
			$result[]=$bill->serialize();
		}
		$this->response(['errors'=>false,'data'=>$result]);
	}

	public function getBillsofProvider($provider_id){
		$result=[];
		$provider=\App\Models\Provider::find([$provider_id]);
		foreach($provider->bills as $bill){
			$result[]=$bill->serialize();
		}
		$this->response(['errors'=>false,'data'=>$result]);
	}

	public function delete($id){
    	$bill=\App\Models\Bill::find([$id]);
    	if($bill->delete()){
        	$this->response(['errors'=>false,'data'=>'Registro Eliminado']);
        }
    	else {
        	$this->response(['errors'=>true,'data'=>'Error Desconocido']);
        }
    }

}


?>