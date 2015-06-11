<?php 


class AutenticacionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /autenticacion
	 *
	 * @return Response
	 */
	public function login()
	{
		if (Session::has('usuario')) {
		 return View::make('inicio/index');	
		}else{
			return View::make('inicio/login');	
		}
	}

	public function Loguear(){
		
	
		$email=Input::get('usuario');
		$password=Input::get('clave');

		$credenciales=array(
			'USUARIO'=>$email,
			'CLAVE'=>md5($password)
		);
		
		return $this->CrearSession($credenciales);

	}

	public function LoguearPorCookie(){
		
		$id=Cookie::get('id_user');
		if ($id>0 && Session::has('usuario')) {
			return Session::get('usuario');
		}
		else if ($id==null) {
			return 0;
		}

		$credenciales=array(
			'ID'=>$id
		);

		return $this->CrearSession($credenciales);

	}

	private function CrearSession($credenciales){

		$usuario=Usuario::where($credenciales)->first();

		if ($usuario!=null) {
			
		    Cookie::queue('id_user', $usuario->ID,100000);			
		
			Session::put('usuario',$usuario);
			if (Session::has('productos')) {			
				//Guardamos la compra en una tabla temporal
				$lista=Session::get('productos');
				if (count($lista)>0) {
				   foreach ($lista as $item) {

				   		$tempComp=TemporalCompra::where('ID_USUARIO','=', $usuario->ID)
								->where('ID_PRODUCTO_PROVEEDOR','=',$item['id'])->first();
						if($tempComp!=null){
							$tempComp->CANTIDAD += $item['cantidad'];
							$tempComp->save();				
						}else{

							if ($this->ValidarPuedeComprarProducto($item['id'])>0) {
								TemporalCompra::create(array(	  
							   	"ID_USUARIO"=>$usuario->ID,
							   	"ID_PRODUCTO_PROVEEDOR"=>$item['id'],
							   	"FECHA_INGRESO"=>DB::raw('NOW()'),
							   	"CANTIDAD"=>$item['cantidad']
							   	));	
							};

					    }
				   }
				}								

			}
			Session::forget('productos');	
		  return $usuario;

		}else{			
		  return array('ID'=>0,'show'=>true,'alert'=>'warning','msg'=>'El usuario o la contraseña no son correctos.');
		}

	}

	private function ValidarPuedeComprarProducto($id_producto_proveedor){
			
			$usuario=Session::get('usuario');

			$barrios=DB::table('barrio_persona')->select('barrio_persona.ID_BARRIO')->where('id_persona',$usuario->ID_PERSONA)->get();
			$vector=array();

			foreach ($barrios as $key => $value) {
				$vector[$key]=$value->ID_BARRIO;
			}

		$count=DB::table('productos_proveedor')
			 ->join('barrio_proveedor','barrio_proveedor.id_proveedor', '=', 'productos_proveedor.id_proveedor')
			 //->select(DB::Raw('count(productos_proveedor.id) as count'))
			 ->where('productos_proveedor.id',$id_producto_proveedor)
			 ->whereIn('barrio_proveedor.id_barrio',$vector)->count('productos_proveedor.ID');

			 return $count;
	}

	public function Logout(){

		/*Session::forget('usuario');
		Session::forget('productos');*/
		Session::flush();
		Cookie::queue('id_user', null);
		$this->DesloguearPorFacebook();
		return 'success';

	}

	public function LogoutPorCookie(){

		Cookie::queue('id_user', null);
		Session::flush();
		//Session::forget('usuario');
		return 'success';

	}

	public function LoguearPorFacebook($auth=NULL){

		if ($auth=='auth') {
			try {
				Hybrid_Endpoint::process();
			} catch (Exception $e) {
				return Redirect::to(Request::root().'/#/login-facebook');
			}

			return;
		}

		$oauth=new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$provider=$oauth->authenticate('Facebook');
		$profile=$provider->getUserProfile();			
		Session::put('facebook',$profile);

		return Redirect::to(Request::root().'/#/login-facebook');
		
	}

	public function DesloguearPorFacebook(){

		Session::forget('facebook');
		$fauth=new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$fauth->logoutAllProviders();
		//return 'deslogueado';
	
	}

	public function ObtenerDatosFacebook(){

		$facebook=Session::get('facebook');

		$user=Usuario::where('USUARIO',$facebook->email)->first();

		if ($user!=null) {
			$credenciales=array(
			'USUARIO'=>$facebook->email		
			);
			return array('login'=>true,'data'=>$this->CrearSession($credenciales));	
		}else{

			$datos=array(
				'correo'=>$facebook->email,
				'no_identificacion'=>'',
				'nombres'=>$facebook->firstName,
				'apellidos'=>$facebook->lastName,
				'telefono'=>$facebook->phone,
				'celular'=>''
			);

			return array('login'=>false,'data'=>$datos);
		}		

	}


	public function LoguearPorGoogle($auth=NULL){

		/*if ($auth=='auth') {
			try {
				Hybrid_Endpoint::process();
			} catch (Exception $e) {
				return Redirect::to(Request::root().'/#/login-facebook');
			}

			return;
		}

		$oauth=new Hybrid_Auth(app_path().'/config/gg_auth.php');
		$provider=$oauth->authenticate('Google');
		$profile=$provider->getUserProfile();	
		dd($profile);	*/	
		//Session::put('facebook',$profile);

			/*$hybridauth=new Hybrid_Auth(app_path().'/config/gg_auth.php');

			if (!$hybridauth->isConnectedWith('Google')) {
			    $adapter = $hybridauth->authenticate('Google');
			}
			else {
			    $adapter = $hybridauth->getAdapter('Google');
			}

			$profile = $adapter->getUserProfile();*/

		 if ($auth=='auth')
        {
            try
            {
                Hybrid_Endpoint::process();
            }
            catch (Exception $e)
            {
                // redirect back to http://URL/connect/
                return Redirect::route('hybridauth')->with('auth', $auth);
            }
            return;
        }

        try
        {
            $socialAuth = new Hybrid_Auth(app_path() . '/config/gg_auth.php');
            $haProvider = $socialAuth->authenticate($auth);
            return 'test';
            $userProfile = $haProvider->getUserProfile();
        }
        catch(Exception $e)
        {
            // exception codes can be found on HybBridAuth's web site
            return $e->getMessage();
        }

        return $userProfile;

	}


}