<?php 
/**
* This is the main controller class, The controllers should inherit from this class (for custom views) or from \Core\Crud (for simple crud scaffolds)
*/
namespace App\Controllers;
class Controller{
	public function __construct(){
		$this->payload = json_decode(file_get_contents("php://input"), TRUE);
		$this->protect_route();
		
	}
	protected function response(array $response){
		header('Content-Type:application/json');
		echo json_encode($response);
		die(); 
	}


	public function protect_route(){
		$secret_key = "YOUR_SECRET_KEY";
		$jwt = null;
		if(!isset($_SERVER['HTTP_AUTHORIZATION']) || !isset($_SERVER['HTTP_SESSION'])){
			http_response_code(401);
			$this->response(['errors'=>true,'message'=>'Unauthorized (Missing Headers)']);
		}
		$session = $_SERVER['HTTP_SESSION'];
		$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
		$arr = explode(" ", $authHeader);
		$jwt = $arr[1];
		if($jwt){
			try{
				$decoded = JWT::decode($jwt, $secret_key, array('HS256'));
				$this->current_user=$decoded->data;
				$user=\App\Models\User::find([$this->current_user->id]);
				if($user->session_token !== $session){
					http_response_code(401);
					$this->response(['errors'=>true,'message'=>'Duplicated','reason'=>'Su cuenta inicio sesion en otro dispositivo']);
				}

				
			}
			catch(\Exception $e){
				http_response_code(403);
				$this->response(['errors'=>true,'message'=>'Unauthorized[JWTException]','reason'=>$e->getMessage()]);
			}
		}
		else{
			http_response_code(401);
			$this->response(['errors'=>true,'message'=>'Unauthorized','reason'=>'No JWT']);
		}
	}

	
}

?>