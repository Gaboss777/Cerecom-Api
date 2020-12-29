<?php 
namespace App\Controllers;
use \Core\View;
class sellsController extends crudController{
	
	public function create(){
    	$sell = new \App\Models\Sell($this->payload);
    	if($sell->save()){
        	$this->response(['errors'=>false,'data'=>$sell->to_array()]);
        }
    	else {
        	http_response_code(400);
        	$this->response(['errors'=>true,'data'=>'No se pudo crear el Pago']);
        }
    }

	public function index(){
		$result=[];
    	$sells = \App\Models\Sell::all();
    	foreach($sells as $sell){
        	$result[]=$sell->serialize();
        }
    	$this->response(['errors'=>false,'data'=>$result]);
	}

	public function getSellsofSeller($seller_id){
    	$result=[];
    	$seller=\App\Models\Seller::find([$seller_id]);
    	foreach($seller->sells as $sell){
        	$result[]=$sell->serialize();
        }
    	$this-response(['errors'=>false,'data'=>$result]);
    }

	public function delete($id){
    	$sell=\App\Models\Sell::find([$id]);
    	if($sell->delete()){
        	$this->response(['errors'=>false,'data'=>'Registro Eliminado']);
        }
    	else {
        	$this->response(['errors'=>true,'data'=>'Error Desconocido']);
        }
    }

}


 ?>