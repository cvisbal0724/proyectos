<?php

class UsuarioController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /usuario
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
	
	public function Crear(){

		DB::beginTransaction();

		try {
						
			$per=Persona::create(array(  
				"NO_IDENTIFICACION"=>Input::get("no_identificacion"),
				"CORTESIA"=>1,//Input::get("cortesia"),
				"NOMBRES"=>Input::get("nombres"),
				"APELLIDOS"=>Input::get("apellidos"),
				"TELEFONO"=>Input::get("telefono"),
				"CELULAR"=>Input::get("celular"),
				"EMAIL"=>Input::get("correo"),
				"ID_MUNICIPIO"=>1,
				//"FECHA_NACIMIENTO"=>date('Y-m-d',strtotime(Input::get("fecha_nacimiento"))),
				"ID_TIPO_IDENTIFICACION"=>1,//Input::get("id_tipo_identificacion"),
				"FECHA_REGISTRO"=>DB::raw("NOW()")		
			));	

			MetodoPagoPersona::create(array(
				'ID_TIPO_METODO_PAGO'=>1,
				'ID_PERSONA'=>$per['ID'],
				'FECHA_CREACION'=>DB::raw('NOW()'),
				'ESTADO'=>1
			));

			/*$dir=BarrioPersona::create(array(

				"ID_PERSONA"=>$per['ID'],
				"ID_BARRIO"=>Input::get("id_barrio"),
				"NOMBRE_SITIO"=>Input::get("nombre_sitio"),
				"DIRECCION"=>Input::get("direccion"),
				"TELEFONO"=>Input::get("telefono"),
				"QUIEN_RECIBE"=>Input::get("quien_recibe"),
				"ESTADO"=>1,
				"FECHA_CREACION"=>DB::raw('NOW()')

			 ));*/

			 $usu=Usuario::create(array(
			  
				"USUARIO"=>Input::get("correo"),	
				"ESTADO"=>0,				
				"ID_PERSONA"=>$per['ID'],
				"ID_PERFIL"=>3,
				"FECHA_CREACION"=>DB::raw('NOW()'),			
			 ));

			 $pwd=md5(Input::get('clave'));
			 $usuario=Usuario::find($usu['ID']);
			 $usuario->CLAVE=$pwd;
			 $usuario->save();

			 $key=array('ID'=>$usu['ID'],'CLAVE'=>$pwd);
			 $arrayString=Encriptacion::encrypt($key, Encriptacion::ENCRYPTION_KEY);
			 $data=array('usuario'=>$usuario->USUARIO,'nombres'=>Input::get("nombres"),
			 	'apellidos'=>Input::get("apellidos"),'clave'=>Input::get('clave'),'key'=>Request::root().'/#/activar/'.$arrayString);

			 Mail::send('plantilla_correo/crear_cuenta', $data, function($message){
		        $message->to(Input::get('correo'), Input::get('nombres').' '.Input::get('apellidos'))->subject('Registro de Usuario');
		     });

	 		 DB::commit();
			 return $usu["ID"];

		} catch (Exception $e) {
			
			DB::rollback();
			return $e;

		}
	
	 
	 }
	 
	 public function CrearConFaceBook(){

		DB::beginTransaction();

		try {
						
			$per=Persona::create(array(  
				"NO_IDENTIFICACION"=>Input::get("no_identificacion"),
				"CORTESIA"=>1,//Input::get("cortesia"),
				"NOMBRES"=>Input::get("nombres"),
				"APELLIDOS"=>'',//Input::get("apellidos"),
				"TELEFONO"=>Input::get("telefono"),
				"CELULAR"=>Input::get("celular"),
				"EMAIL"=>Input::get("correo"),
				"ID_MUNICIPIO"=>1,
				//"FECHA_NACIMIENTO"=>date('Y-m-d',strtotime(Input::get("fecha_nacimiento"))),
				"ID_TIPO_IDENTIFICACION"=>1,//Input::get("id_tipo_identificacion"),
				"FECHA_REGISTRO"=>DB::raw("NOW()")		
			));	

			MetodoPagoPersona::create(array(
				'ID_TIPO_METODO_PAGO'=>1,
				'ID_PERSONA'=>$per['ID'],
				'FECHA_CREACION'=>DB::raw('NOW()'),
				'ESTADO'=>1
			));

			
			 $usu=Usuario::create(array(
			  
				"USUARIO"=>Input::get("correo"),	
				"ESTADO"=>0,				
				"ID_PERSONA"=>$per['ID'],
				"ID_PERFIL"=>3,
				"FECHA_CREACION"=>DB::raw('NOW()'),			
			 ));

			 $pwd=md5(Input::get('no_identificacion'));
			 $usuario=Usuario::find($usu['ID']);
			 $usuario->CLAVE=$pwd;
			 $usuario->save();
					
	 		 DB::commit();

			 return $usu["ID"];

		} catch (Exception $e) {
			
			DB::rollback();
			return $e;

		}
	
	 
	 }
	 
	public function Modificar(){
	 
	 	$id=Input::get("id");
	 	DB::beginTransaction();

	 	try {
	 	
	 	$usuario=Usuario::find($id);
		$usuario->FECHA_MODIFICACION=DB::raw('NOW()');
		//$usuario->ESTADO=Input::get("estado");
		$usuario->ID=Input::get("id");
		$usuario->ID_PERSONA=Input::get("id_persona");
		//$usuario->ID_PERFIL=Input::get("id_perfil");
		$usuario->USUARIO=Input::get("usuario");
		$usuario->CLAVE=md5(Input::get('clave'));		
		$rs=$usuario->save();
	 	
	 	$persona=Persona::find(Input::get("id_persona"));

	 	$persona->NOMBRES=Input::get('nombres');
	 	$persona->APELLIDOS=Input::get('apellidos');
	 	$persona->ID_TIPO_IDENTIFICACION=Input::get('id_tipo_identificacion');
	 	$persona->NO_IDENTIFICACION=Input::get('no_identificacion');
	 	$persona->CORTESIA=Input::get('cortesia');
	 	$persona->CELULAR=Input::get('celular');
	 	$persona->EMAIL=Input::get('correo');
	 	//$persona->FECHA_NACIMIENTO=Input::get('fecha_nacimiento');
	 	$persona->save();

	 	DB::commit();
	 	return array('alert'=>'success','msg'=>'Sus datos fueron actualizados correctamente.','show'=>true);

	 	} catch (Exception $e) {
	 		DB::rollback();
	 		return array('alert'=>'danger','msg'=>$e->message,'show'=>true);
			//throw $e;
	 	}
	 	
	 }
	 
	 public function RecuperarClave($correo){
	 	try {
						
			$condicion=array('USUARIO'=>$correo);

			$usuario=Usuario::where($condicion)->first();

			if ($usuario) {

				$key=array('ID'=>$usuario->ID);
				$arrayString=Encriptacion::encrypt($key, Encriptacion::ENCRYPTION_KEY);
				$data=array('nombres'=>$usuario->persona->NOMBRES,'key'=>Request::root().'/#/cambiar-contrasena/'.$arrayString);
				Session::put('correo',$correo);

				Mail::send('plantilla_correo/recordar_clave', $data, function($message){
		        	$message->to(Session::get('correo'));
		        	$message->subject('Recordar Contraseña');
		     	});

				return array('alert'=>'success','msg'=>'Hemos enviado un mensaje a su correo para restablecer su contraseña.','show'=>true);

			}else{
				return array('alert'=>'danger','msg'=>'Lo sentimos su correo no esta registrado en nuestra plataforma.','show'=>true);				
			}

			} 
			catch (Exception $e) {
				return array('alert'=>'danger','msg'=>$e .'Un error ha ocurrido consulte al administrador.','show'=>true);
			}
	 }

	 public function CambiarClave(){

	 	try {
	 	
	 		$key=Input::get('key');
		 	$clave=md5(Input::get('clave'));
			$obj=Encriptacion::decrypt($key, Encriptacion::ENCRYPTION_KEY);		
			$usuario=Usuario::find($obj['ID']);

			if ($usuario) {
				$usuario->CLAVE=$clave;
				$usuario->save();
			}

			return 'success';

	 	} catch (Exception $e) {
	 		return 'error';
	 	}
	 	
	 }

	 public function Eliminar(){
	 
	 $id=Input::get("id");
	 
	 $usuario=Usuario::find($id);
	 $rs=$usuario->delete();
	 
	 }
	 
	public function ObtenerPorID(){
	 
	 $id=Input::get("id");
	 return Usuario::find($id)->toJSON();
	 
	 }
	 
	 
	public function ObtenerTodos(){
	 
	 return Usuario::all()->toJSON();
	 
	}
	 
	public function ObtenerCuenta(){

		$id_user=Cookie::get('id_user');
		$usuario=Usuario::find($id_user);
		
		$cuenta=array(
			'id'=>$usuario->ID,
			'fecha_registro'=>date('Y-m-d',strtotime($usuario->FECHA_CREACION)),
			'usuario'=>$usuario->USUARIO,
			'cortesia'=>$usuario->Persona->CORTESIA,
			'no_identificacion'=>$usuario->Persona->NO_IDENTIFICACION,
			'id_tipo_identificacion'=>$usuario->Persona->ID_TIPO_IDENTIFICACION,
			'nombres'=>$usuario->Persona->NOMBRES,
			'apellidos'=>$usuario->Persona->APELLIDOS,
			'correo'=>$usuario->Persona->EMAIL,
			'telefono'=>$usuario->Persona->TELEFONO,
			'celular'=>$usuario->Persona->CELULAR,
			'fecha_nacimiento'=>$usuario->Persona->FECHA_NACIMIENTO,
			'id_persona'=>$usuario->ID_PERSONA
		);

		return $cuenta;
	} 

	public function ObtenerTipoIdentificacion(){
		return TipoIdentificacion::all()->toJSON();
	}

	public function ActivarCuenta(){
		try {
			$key=Input::get('key');
			$obj=Encriptacion::decrypt($key, Encriptacion::ENCRYPTION_KEY);
			
			$usuario=Usuario::where($obj)->first();
			$usuario->ESTADO=1;
			$usuario->save();

		return $usuario->ID > 0 ? array('alert'=>'success','msg'=>'La cuenta se ha activado satisfactoriamente.') :
		array('alert'=>'danger','msg'=>'Un error ha ocurrido consulte al administrador.');
		} catch (Exception $e) {
			return array('alert'=>'danger','msg'=>$e .'Un error ha ocurrido consulte al administrador.');
		}
		
	}

	



}