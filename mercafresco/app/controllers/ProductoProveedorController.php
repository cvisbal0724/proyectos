<?php

class ProductoProveedorController extends BaseController {

	//protected $rutaImagen = 'productos/';
	protected $rutaImagen ='administrador/source/imagen_productos/';

	/**
	 * Display a listing of the resource.
	 * GET /productoproveedor
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function Crear(){
 		
 		$rs=ProductosProveedor::create(array(
  
		"IVA_TASA"=>Input::get("iva_tasa"),
		"ID_PROVEEDOR"=>Input::get("id_proveedor"),
		"ID_PRODUCTO"=>Input::get("id_producto"),		
		"ID_FABRICANTE"=>Input::get("id_fabricante"),
		"ESTADO"=>Input::get("estado"),
		"ID_UNIDAD"=>Input::get("id_unidad"),
		"ID_IVA"=>Input::get("id_iva"),
		"DESCRIPCION"=>Input::get("descripcion"),
		"ARCHIVO_FOTO"=>Input::get("archivo_foto"),
		"PRECIO"=>Input::get("precio"),
		"INVENTARIO"=>Input::get("inventario"),
		"PRODUCTOS_OFRECIDOS"=>Input::get("productos_ofrecidos"),		
		));
 
	 return $rs["ID"];
	 
	 }
 
 
public function Modificar(){
 
 $id=Input::get("id");
 
  	$productos_proveedor=ProductosProveedor::find($id);
	$productos_proveedor->ID_PRODUCTO=Input::get("id_producto");
	$productos_proveedor->FECHA_MODIFICACION=Input::get("fecha_modificacion");
	$productos_proveedor->ID_FABRICANTE=Input::get("id_fabricante");
	$productos_proveedor->ESTADO=Input::get("estado");
	$productos_proveedor->ID_UNIDAD=Input::get("id_unidad");
	$productos_proveedor->ID_IVA=Input::get("id_iva");
	$productos_proveedor->DESCRIPCION=Input::get("descripcion");
	$productos_proveedor->ARCHIVO_FOTO=Input::get("archivo_foto");
	$productos_proveedor->PRECIO=Input::get("precio");
	$productos_proveedor->INVENTARIO=Input::get("inventario");
	$productos_proveedor->PRODUCTOS_OFRECIDOS=Input::get("productos_ofrecidos");
	$productos_proveedor->ID=Input::get("id");
	$productos_proveedor->IVA_TASA=Input::get("iva_tasa");
	$productos_proveedor->ID_PROVEEDOR=Input::get("id_proveedor");
	$productos_proveedor->FECHA_CREACION=Input::get("fecha_creacion");
	$rs=$productos_proveedor->save();
 	return $rs > 0 ? 'true' : 'false';
 
 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $productos_proveedor=ProductosProveedor::find($id);
 $rs=$productos_proveedor->delete();
 
 }
 
 
public function ObtenerPoID(){
 
 $id=Input::get("id");
 return ProductosProveedor::find($id)->toJSON();
 
 }
 
 
public function ObtenerTodos(){
 
  return ProductosProveedor::all()->toJSON();  
  
 }
 
 public function ObtenerInicio(){
 	 	
 	$categorias=Categoria::all();
 	$result=array();

 	$id_user=Cookie::get('id_user');
	
	if ($id_user > 0) {
		
		$usuario=Usuario::where('ID',$id_user)->first();

		$barrios=DB::table('barrio_persona')->select('barrio_persona.ID_BARRIO')->where('id_persona',$usuario->ID_PERSONA)->get();
		$vector=array();

	if (count($barrios)>0) {
		
		foreach ($barrios as $key => $value) {
			$vector[$key]=$value->ID_BARRIO;
		}

		foreach ($categorias as $row) {
	 		
	 			$detalle=$this->consulta()
		 		->where('categoria.id',$row->ID)		 		
		 		->whereIn('barrio_proveedor.id_barrio',$vector)->groupBy('productos_proveedor.id')->take(10)->get();
		 		if (count($detalle)>0) {
		 			$result[]=array(
			 		 'id_categoria'=>$row->ID,		
			 		 'categoria'=>$row->NOMBRE,	
			 		 'productos'=>$detalle);	
		 		}
		 		 
	 	}
	 }else{
	 	foreach ($categorias as $row) {
	 		
		 		 $result[]= 
		 		 array(
		 		 'id_categoria'=>$row->ID,		
		 		 'categoria'=>$row->NOMBRE,	
		 		 'productos'=>$this->consulta()
		 		->where('categoria.id',$row->ID)->take(10)->groupBy('productos_proveedor.id')->get());	
	 	}
	 }

	}else{
	
	 	foreach ($categorias as $row) {
	 		
		 		 $result[]= 
		 		 array(
		 		 'id_categoria'=>$row->ID,		
		 		 'categoria'=>$row->NOMBRE,	
		 		 'productos'=>$this->consulta()
		 		->where('categoria.id',$row->ID)->take(10)->groupBy('productos_proveedor.id')->get());	
	 	}
 	}
 	return $result;

 }
 
	 public function ObtenerPorCategorias(){

	 	$id_user=Cookie::get('id_user');

	 	$id_categoria=Input::get('id_categoria');

	 	$categoria=Categoria::find($id_categoria);
	 	
	 	if ($id_user > 0) {
		
			$usuario=Usuario::where('ID',$id_user)->first();

			$barrios=DB::table('barrio_persona')->select('barrio_persona.ID_BARRIO')->where('id_persona',$usuario->ID_PERSONA)->get();
			$vector=array();

			if (count($barrios)>0) {

			foreach ($barrios as $key => $value) {
				$vector[$key]=$value->ID_BARRIO;
			}
		
			  $result[]=  array(
			  'id_categoria'=>$categoria->ID,	
			   'categoria'=>$categoria->NOMBRE,	
			  'productos'=>$this->consulta()
			 ->where('categoria.id',$id_categoria)			 
			 ->whereIn('barrio_proveedor.id_barrio',$vector)->groupBy('productos_proveedor.id')->get());	
		 	}
		 	else{
		 		$result[]= 
			 	 array(
			 	 'id_categoria'=>$categoria->ID,	
			 	 'categoria'=>$categoria->NOMBRE,	
			 	 'productos'=>$this->consulta()			 	
			 	->where('categoria.id',$id_categoria)->groupBy('productos_proveedor.id')->get());	
		 	}

		}else{

		 		$result[]= 
			 	 array(
			 	 'id_categoria'=>$categoria->ID,	
			 	 'categoria'=>$categoria->NOMBRE,	
			 	 'productos'=>$this->consulta()			 	
			 	->where('categoria.id',$id_categoria)->groupBy('productos_proveedor.id')->get());	
		}

		return $result; 	 
	 }

	public function ObtenerPorParecidos(){
		
		$input=Input::get('criterio');

		$id_user=Cookie::get('id_user');

	 	if ($id_user > 0) {
		
			$usuario=Usuario::where('ID',$id_user)->first();

			$barrios=DB::table('barrio_persona')->select('barrio_persona.ID_BARRIO')->where('id_persona',$usuario->ID_PERSONA)->get();
			$vector=array();

			if (count($barrios)>0) {

			foreach ($barrios as $key => $value) {
				$vector[$key]=$value->ID_BARRIO;
			}
		
			  $result[]= 
		 	 array(
		 	 'id_categoria'=>'',	
		 	 'categoria'=>'',	
		 	 'productos'=>$this->consulta()
		 	->where('producto.nombre','LIKE', '%'.$input.'%')->whereIn('barrio_proveedor.id_barrio',$vector)
		 	->orWhere('productos_proveedor.descripcion','LIKE','%'.$input.'%')
		 	->where('productos_proveedor.INVENTARIO','>',0)
		 	->whereIn('barrio_proveedor.id_barrio',$vector)->groupBy('productos_proveedor.id')->get());	
		   }else{

		   	$result[]= 
		 	 array(
		 	 'id_categoria'=>'',	
		 	 'categoria'=>'',	
		 	 'productos'=>$this->consulta()
		 	->where('producto.nombre','LIKE', '%'.$input.'%')->orWhere('productos_proveedor.descripcion','LIKE','%'.$input.'%')
		 	 ->where('productos_proveedor.INVENTARIO','>',0)
		 	 ->groupBy('productos_proveedor.id')->get());	
		 	 
		   }

		}else{

		 	$result[]= 
		 	 array(
		 	 'id_categoria'=>'',	
		 	 'categoria'=>'',	
		 	 'productos'=>$this->consulta()
		 	->where('producto.nombre','LIKE', '%'.$input.'%')->orWhere('productos_proveedor.descripcion','LIKE','%'.$input.'%')
		 	->where('productos_proveedor.INVENTARIO','>',0)
		 	 ->groupBy('productos_proveedor.id')->get());	
		}

		return $result; 	 

	}

	public function ObtenerPorIDProvedorProducto(){

		$id_producto_proveedor=Input::get('id_producto_proveedor');

		$result= 
		 array(
		 'id_categoria'=>'',	
		 'categoria'=>'',	
		 'productos'=>$this->consulta()		
		->where('productos_proveedor.id',$id_producto_proveedor)->first());

		return $result; 	 
	 }

 	//agrega productos a la variable de session
	public function AgregarCanasta(){

		try {
	

		$superoCantidad=false;
		$id_user=Cookie::get('id_user');
		$id_producto_proveedor=Input::get('id_producto_proveedor');	
		$cantidad=Input::get('cantidad');
		$lista=array();

		$prodProv=ProductosProveedor::find($id_producto_proveedor);
		
		 if ($prodProv->INVENTARIO==0) {
			return array('result'=>'error','data'=>'','msg'=>'Lo sentimos no tenemos cantidades disponible en el momento para este producto.');	
		 }	

		 if ($cantidad > $prodProv->INVENTARIO) {
		 	$cantidad=$prodProv->INVENTARIO;
		 	$superoCantidad=true;		 	
		 }

		//si no esta logueado
		if ($id_user==null) {
				
				//si no tiene productos agregados sin loguearse
			if (!Session::has('productos')) {
				
				$lista[]=array(
				'id'=>$prodProv->ID,
				'cantidad'=>$cantidad,
				'id_unidad'=>$prodProv->ID_UNIDAD,
				'nombre'=>$prodProv->Producto->NOMBRE,
				'precio'=>$prodProv->PRECIO,
				'imagen'=>$this->rutaImagen . $prodProv->ARCHIVO_FOTO
				);			
				Session::put('productos',$lista);
			}else{

				$lista = Session::get('productos');
				$existe=false;				

				foreach ($lista as $key => $row) {

					if ($row['id']==$id_producto_proveedor) {
						$lista[$key]['cantidad']=$cantidad;
						$existe=true;
						break;
					}
				}
					if (!$existe) {						
						$lista[]=array(
						'id'=>$prodProv->ID,
						'cantidad'=>$cantidad,
						'id_unidad'=>$prodProv->ID_UNIDAD,
						'nombre'=>$prodProv->Producto->NOMBRE,
						'precio'=>$prodProv->PRECIO,
						'imagen'=>$this->rutaImagen . $prodProv->ARCHIVO_FOTO
						);			
					}
							
				Session::put('productos',$lista);
			}
		}else{

			//$usuario=Session::get('usuario');

			$tempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)
			->where('ID_PRODUCTO_PROVEEDOR','=',$id_producto_proveedor)->first();
			
			if($tempComp!=null){
				$tempComp->CANTIDAD = $cantidad;
				$tempComp->save();				
			}
			else{
				 TemporalCompra::create(array(	  
				 "ID_USUARIO"=>$id_user,
				 "ID_PRODUCTO_PROVEEDOR"=>$id_producto_proveedor,
				 "CANTIDAD"=>$cantidad,
				 "FECHA_INGRESO"=>DB::raw('NOW()')
				 ));	
			}

			$lista=$this->ObtenerTemporalCompra();
			
		}

		if ($superoCantidad) {
			return array('result'=>'notice','data'=>$lista,'msg'=>'La cantidad solicitada ha superado nuestro inventario. En el momento tenemos disponible ' . $prodProv->INVENTARIO .' las cuales hemos incluido en su canasta.');
		}else{
			return array('result'=>'success','data'=>$lista,'msg'=>'');
		}
		} catch (Exception $e) {
			Excepciones::Crear($e,'ProductosProveedorController','AgregarCanasta');
			return array('result'=>'danger','data'=>'','msg'=>$e->getMessage());	
		}
	}

	public function AgregarCantidadesDesdeCanasta(){
		
		try
		{
		$id_user=Cookie::get('id_user');
		$id_producto_proveedor=Input::get('id_producto_proveedor');	
		$cantidad=Input::get('cantidad');
		$lista=array();

		$prodProv=ProductosProveedor::find($id_producto_proveedor);

		if ($prodProv->INVENTARIO==0) {
			return array('result'=>'error','data'=>'Lo sentimos no tenemos cantidades disponible en el momento para este producto.');	
		}	
		
		if ($id_user==null) {
			$lista = Session::get('productos');
			foreach ($lista as $key => $row) {
				if ($row['id']==$id_producto_proveedor) {

					 if (($lista[$key]['cantidad']+$cantidad) > $prodProv->INVENTARIO) {		 	
		 				return array('result'=>'error','data'=>'No puede agregar mas cantidades de este producto a su canasta porque han agotado.');
		 			 }
					$lista[$key]['cantidad'] +=$cantidad;				
					break;
				}
			}
			Session::put('productos',$lista);
		}else{

			
			$tempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)
			->where('ID_PRODUCTO_PROVEEDOR','=',$id_producto_proveedor)->first();

			if (($tempComp->CANTIDAD+$cantidad) > $prodProv->INVENTARIO) {		 	
		 		return array('result'=>'error','data'=>'No puede agregar mas cantidades de este producto a su canasta porque han agotado.');
		 	}
		 	
			$tempComp->CANTIDAD +=$cantidad;
			$tempComp->save();

			$lista=$this->ObtenerTemporalCompra();

		}
		
		
		return array('result'=>'success','data'=>$lista);

		} catch (Exception $e) {
			Excepciones::Crear($e,'ProductosProveedorController','AgregarCantidadesDesdeCanasta');
			return array('result'=>'danger','data'=>'','msg'=>$e->getMessage());	
		}

	}

	//Muestra los productos que estan en la session o en la 
	//tabla temporal
	public function CargarProductosAgregados(){
		//Session::flush();		
		$id_user=Cookie::get('id_user');
		$lista = Session::get('productos');
		if ($id_user==null && count($lista)>0) {
			$lista = Session::get('productos');
			return $lista;
		}else if($id_user > 0){
			//$usuario=Session::get('usuario');
			$listTemp=TemporalCompra::where('ID_USUARIO','=',$id_user)->get();
			
			$listaProductos=array();
			foreach ($listTemp as $item) {
				$prodProv=ProductosProveedor::find($item->ID_PRODUCTO_PROVEEDOR);
				$listaProductos[]=array(
					'id'=>$prodProv->ID,
					'cantidad'=>$item->CANTIDAD,
					'id_unidad'=>$prodProv->ID_UNIDAD,
					'nombre'=>$prodProv->Producto->NOMBRE,
					'precio'=>$prodProv->PRECIO,
					'imagen'=>$this->rutaImagen.$prodProv->ARCHIVO_FOTO
					);	
			}

			return $listaProductos;
		}
		return array();		
	}

	public function RemoveProductoAgregado($id){
		try{
		$id_user=Cookie::get('id_user');
		if ($id_user==null) {
			$lista = Session::get('productos');
			 if (count($lista)>0) {
			   foreach ($lista as $key =>$row) {
			   	if ($id==$row['id']) {						
			   		unset($lista[$key]);					
			   	}
			   }					
			 }				
					
			Session::put('productos',$lista);			
		}else{
			//$usuario=Session::get('usuario');
			TemporalCompra::where('ID_USUARIO','=', $id_user)
			->where('ID_PRODUCTO_PROVEEDOR','=',$id)->delete();

			return $this->ObtenerTemporalCompra();

		}

		return $lista;
		} catch (Exception $e) {
			Excepciones::Crear($e,'ProductosProveedorController','RemoveProductoAgregado');
			return array();	
		}
	}

	private function ObtenerTemporalCompra(){

		//$usuario=Session::get('usuario');
		$id_user=Cookie::get('id_user');
		$lista=DB::table('temporal_compra')->
			join('productos_proveedor','temporal_compra.ID_PRODUCTO_PROVEEDOR','=','productos_proveedor.ID')->
			join('producto','productos_proveedor.ID_PRODUCTO','=','producto.ID')->
			select(DB::raw("productos_proveedor.id,temporal_compra.cantidad,productos_proveedor.id_unidad,
				producto.nombre,productos_proveedor.precio,concat('".$this->rutaImagen."' , productos_proveedor.archivo_foto) as imagen"))
			->where('temporal_compra.id_usuario',$id_user)->get();
		return $lista;	
	}

	public function AgregarListaCompra(){
		try{
		$id_user=Cookie::get('id_user');
		$lista=Input::get('lista');
		
		foreach ($lista as $row) {

			$tempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)
			->where('ID_PRODUCTO_PROVEEDOR','=',$row['id_producto_proveedor'])->first();
			$prodProv=ProductosProveedor::find($row['id_producto_proveedor']);
		
			if ($prodProv->INVENTARIO > 0) {
				if($tempComp!=null){
					$tempComp->CANTIDAD += $row['cantidad'];
					$tempComp->save();				
				}
				else{				
					
				   TemporalCompra::create(array(	  
				   "ID_USUARIO"=>$id_user,
				   "ID_PRODUCTO_PROVEEDOR"=>$row['id_producto_proveedor'],
				   "CANTIDAD"=>$row['cantidad'],
				   "FECHA_INGRESO"=>DB::raw('NOW()')
				   ));				
						
				}
			}

		}

		return 'true';
		} catch (Exception $e) {
			Excepciones::Crear($e,'ProductosProveedorController','AgregarListaCompra');
			return 'false';	
		}
	}

	private function consulta(){

		$id_user=Cookie::get('id_user');
		if($id_user > 0){
		return DB::table('productos_proveedor')
		 	->join('producto','productos_proveedor.id_producto', '=', 'producto.id')
		 	->join('categoria','producto.id_categoria', '=', 'categoria.id')
		 	->join('unidad','productos_proveedor.id_unidad', '=', 'unidad.id')	 
		 	->join('barrio_proveedor','barrio_proveedor.id_proveedor', '=', 'productos_proveedor.id_proveedor')	
		 	->select(DB::Raw("productos_proveedor.id, producto.nombre,productos_proveedor.id_unidad,productos_proveedor.descripcion,productos_proveedor.productos_ofrecidos,
	 				categoria.nombre as categoria, productos_proveedor.precio,unidad.id as id_unidad, unidad.nombre as unidad, 1 as cantidad, concat('".$this->rutaImagen."', productos_proveedor.archivo_foto) as imagen"))
		 	->where('productos_proveedor.INVENTARIO','>',0);
		 }else{
		 	return DB::table('productos_proveedor')
		 	->join('producto','productos_proveedor.id_producto', '=', 'producto.id')
		 	->join('categoria','producto.id_categoria', '=', 'categoria.id')
		 	->join('unidad','productos_proveedor.id_unidad', '=', 'unidad.id')	 		 	
		 	->select(DB::Raw("productos_proveedor.id, producto.nombre,productos_proveedor.id_unidad,productos_proveedor.descripcion,productos_proveedor.productos_ofrecidos,
	 				categoria.nombre as categoria, productos_proveedor.precio,unidad.id as id_unidad,unidad.nombre as unidad, 1 as cantidad,concat('".$this->rutaImagen."', productos_proveedor.archivo_foto) as imagen"))
		 	->where('productos_proveedor.INVENTARIO','>',0);

		 }
	}


}