<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Auth;

class AutenticacionController extends Controller {


	use AuthenticatesAndRegistersUsers;

	public function index()
	{
		return view('inicio/login',array('_token'=>csrf_token()));
	}

	public function Loguear(Request $request){
		try {

			$credenciales=array('usuario' => $request->input('usuario'), 'password' => $request->input('clave'));
			
			if (Auth::attempt($credenciales))
			{
				$usuario=array(
					'auth'=>Auth::check(),
					'nombre'=>Auth::User()->persona->nombre . ' ' . Auth::User()->persona->apellido,
					'_token'=>csrf_token()
				);
			    return $usuario;
			}else{
				return array('show'=>true,'alert'=>'warning','msg'=>'Creadenciales invalidas.');
			}

		} catch (Exception $e) {
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Desloguear(){
		try {
			Auth::logout();
			$usuario=array(
					'auth'=>false,
					'nombre'=>'',
					'_token'=>csrf_token()
				);
			return $usuario;
		} catch (Exception $e) {
			return $e;
		}		
	}

	public function VerificarLogueo(){
		try {
			
			$usuario=array();
			if (Auth::check()) {				
				$usuario=array(
					'auth'=>Auth::check(),
					'nombre'=>Auth::User()->persona->nombre . ' ' . Auth::User()->persona->apellido,
					'_token'=>csrf_token()
				);
			}else{
				$usuario=array(
					'auth'=>false,
					'nombre'=>'',
					'_token'=>csrf_token()
				);
			}
			
			return $usuario;
		} catch (Exception $e) {
			return $e;
		}		
	}

public function test(){
	return Auth::User();
}

}
