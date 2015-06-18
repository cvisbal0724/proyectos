<?php

class OrdenServicio extends \Eloquent {
	protected $table = 'orden_servicio';
	protected $primaryKey='ID';
	protected $with = array('proveedor','usuario','estadoentrega','estadopago','tipometodopago','barriopersona','bono');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}

	public function Usuario(){
		return $this->belongsTo('Usuario', 'ID_USUARIO','ID');
	}

	public function EstadoEntrega(){
		return $this->belongsTo('EstadoEntrega', 'ID_ESTADO_ENTREGA','ID');
	}

	public function EstadoPago(){
		return $this->belongsTo('EstadoPago', 'ID_ESTADO_PAGO','ID');
	}

	public function TipoMetodoPago(){
		return $this->belongsTo('TipoMetodoPago', 'ID_TIPO_METODO_PAGO','ID');
	}

	public function BarrioPersona(){
		return $this->belongsTo('BarrioPersona', 'ID_BARRIO_PERSONA','ID');
	}

	public function Bono(){
		return $this->belongsTo('Bonos', 'ID_BONO','ID');
	}

	public function Total(){

		$result=DB::select('select sum(precio * cantidad_comprados) as total from historial_compra where id_orden_servicio='.$this->ID);		
		
		return $result[0]->total;
		
	}

	public function CantidadProductos(){

		$total=DB::table('historial_compra')->where('ID_ORDEN_SERVICIO',$this->ID)->sum('CANTIDAD_COMPRADOS');	
		return $total;
		
	}

	public function Convenio(){

		$result=DB::select('select ifnull(sum(hc.precio * (ec.porcentaje / 100)),0) as convenio from 
							historial_compra hc
							inner join empresa_convenio ec on hc.ID_EMPRESA_CONVENIO=ec.ID
							where hc.ID_ORDEN_SERVICIO='.$this->ID.' and ec.id in (select ID_EMPRESA_CONVENIO from historial_compra where ID_ORDEN_SERVICIO='.$this->ID.')');		
		
		return $result[0]->convenio;
		
	}

	public function DescuentoBono(){

		$result=DB::select('select 
							ifnull(sum(hc.precio * (b.descuento / 100)),0) as decuento
							from historial_compra hc
              				inner join orden_servicio os on hc.id_orden_servicio=os.id
							inner join
							usuario_bono ub on os.id_bono=ub.id_bono and os.id_usuario=ub.id_usuario
							inner join bonos b on ub.id_bono=b.id
							where hc.id_orden_servicio='.$this->ID);
		return $result[0]->decuento;
		
	}

	/*public function Detalle(){
		return $this->hasMany('HistorialCompra', 'ID_ORDEN_SERVICIO','ID');		
	}*/
}