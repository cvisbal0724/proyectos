<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Auth;

class AtenticacionController extends Controller {


	use AuthenticatesAndRegistersUsers;

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
				return $usuario;
			}

		} catch (Exception $e) {
			return $e;
		}
	}
	
}
