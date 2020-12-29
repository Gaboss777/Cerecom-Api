<?php 
namespace App\Controllers;
use \Core\View;
class providersController extends Controller{
	

	public function create(){
		$provider = new \App\Models\Provider($this->payload);
		if($provider->save()){
			$this->response(['errors'=>false,'data'=>$provider->to_array()]);
		}
		else{
			http_response_code(400);
			$this->response(['errors'=>false,'data'=>"No se pudo crear el proveedor"]);
		}
	}

	public function index(){
		$result=[];
		$providers = \App\Models\Provider::all();
		foreach($providers as $provider){
			$result[]=$provider->serialize();
		}
		$this->response(['errors'=>false,'data'=>$result]);
	}

	public function delete($id){
    	$provider=\App\Models\Provider::find([$id]);
    	if($provider->delete()){
        	$this->response(['errors'=>false,'data'=>'Registro Eliminado']);
        }
    	else {
        	$this->response(['errors'=>true,'data'=>'Error Desconocido']);
        }
    }
}


 ?>