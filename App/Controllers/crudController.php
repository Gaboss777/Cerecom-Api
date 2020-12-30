<?php 
/**
* This is the main controller class, The controllers should inherit from this class (for custom views) or from \Core\Crud (for simple crud scaffolds)
*/
namespace App\Controllers;
class crudController{
	public function __construct(){
		$this->payload = json_decode(file_get_contents("php://input"), TRUE);
		// $this->protect_route();
	}
	protected function response(array $response){
		header('Content-Type:application/json');
		echo json_encode($response);
		die(); 
	}

	public function index(){
		$result=[];
		$resources = $this::$model::all();
		foreach($resources as $resource){
			$result[]=$resource->serialize();
		}
		$this->response(['errors'=>false,'data'=>$result]);
	}

	public function create(){
		$resource = new $this::$model($this->payload);
		if($resource->save()){
			$this->response(['errors'=>false,'data'=>$resource->serialize()]);
		}
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}

	}

	public function update($id){
		$resource = $this::$model::find([$id]);
		if($resource->update_attributes($this->payload)){
			$this->response(['errors'=>false,'data'=>$resource->serialize()]);
		} 
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}
	}

	public function delete($id){
		$resource = $this::$model::find([$id]);
		if($resource->delete($this->payload)){
			$this->response(['errors'=>false,'data'=>'Registro Eliminado']);
		} 
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}
	}

	public function show($id){
		$resource = $this::$model::find([$id]);
		$this->response(['errors'=>false,'data'=>$resource->serialize()]);
	}

	
	// public function protect_route(){
	// 	$secret_key = "YOUR_SECRET_KEY";
	// 	$jwt = null;
	// 	if(!isset($_SERVER['HTTP_AUTHORIZATION'])){
	// 		http_response_code(401);
	// 		$this->response(['errors'=>true,'message'=>'Unauthorized (Missing Headers)']);
	// 	}
	// 	$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
	// 	$arr = explode(" ", $authHeader);
	// 	$jwt = $arr[1];
	// 	if($jwt){
	// 		try{
	// 			$decoded = JWT::decode($jwt, $secret_key, array('HS256'));
	// 			$this->current_user=$decoded->data;
	// 			$user=\App\Models\User::find([$this->current_user->id]);
	// 			if($user->session_token !== $session){
	// 				http_response_code(401);
	// 				$this->response(['errors'=>true,'message'=>'Duplicated','reason'=>'Su cuenta inicio sesion en otro dispositivo']);
	// 			}

				
	// 		}
	// 		catch(\Exception $e){
	// 			http_response_code(403);
	// 			$this->response(['errors'=>true,'message'=>'Unauthorized[JWTException]','reason'=>$e->getMessage()]);
	// 		}
	// 	}
	// 	else{
	// 		http_response_code(401);
	// 		$this->response(['errors'=>true,'message'=>'Unauthorized','reason'=>'No JWT']);
	// 	}
	// }

	
}

?>