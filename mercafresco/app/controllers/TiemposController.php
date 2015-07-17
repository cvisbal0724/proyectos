<?php

class TiemposController extends BaseController {


	public function GenerarTiempos(){

		$id_user=Cookie::get('id_user');
		$dia=NULL;
		$encontro_proveenza = false;
		$encontro_verduras  = false;
		$tiempos=array();
		$Horas = array(8  => '08 - 10 am',
		 10 => '10 - 12 m',
		 12 => '12- 02 pm',
		 14 => '02 - 04 pm',
		 16 => '04 - 06 pm');

		$listaTempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)->get();
		$proveedor=Proveedor::find(1);//Mercafresco

		foreach ($listaTempComp as $key => $item) {
			
			$producto_proveedor=ProductosProveedor::find($item->ID_PRODUCTO_PROVEEDOR);

			if ($producto_proveedor->ID_FABRICANTE==enFabricante::MercaFresco)
			{
				$encontro_verduras = true;
			}

			if ($producto_proveedor->ID_FABRICANTE==enFabricante::LaProvensa)
			{
				$encontro_proveenza = true;
			}

		}

		// Cantidad de envios
		$cantidad_envios   = $proveedor->CANTIDAD_ENVIOS;
		$hora_finalizacion = $proveedor->HORA_FINALIZACION;
		// Fin de cantidad de envios

		// Si pasa de las 6PM entonces muestra el dia siguiente
		if ($encontro_proveenza == true) {

			if (date("G") >= 12) {

				$dia = 2;
			}
			else {

				$dia = 1;
			}
		}else{

			if (date("G") >= $hora_finalizacion) {

				$dia = 2;
			}
			else {

				$dia = 1;
			}
		}
		/*elseif ($encontro_proveenza == true && $encontro_verduras == false) {

			if (date("G") >= 12) {

				$dia = 2;
			}
			else {

				$dia = 1;
			}
		}
		elseif ($encontro_proveenza == true && $encontro_verduras == true) {

			if (date("G") >= 12) {

				$dia = 2;
			}
			else {

				$dia = 1;
			}
		}*/

		$k=0;
		for ($i=$dia; $i < 20 ; $i++) { 

			$fecha = date("Y-m-d", strtotime("+$i day"));
			
			$diasfectivo = DiasFestivos::where('FECHA',$fecha)->get();
			
			if (count($diasfectivo)==0) {

				$k++;

				$horasDisponibles=array();

				for ($j=8; $j < 18 ; $j++) { 

					$ordenes=OrdenServicio::where('PROG_FECHA',$fecha)->where('PROG_HORA',$j)->where('ID_PROVEEDOR',1)->get();

					$mostra=count($ordenes) < $cantidad_envios;
					$chequeado=false;

					
					if (Session::has('hora') && Session::get('hora')==$j && 
						Session::has('fecha') && Session::get('fecha')==$fecha) {
						$chequeado=true;
					}

					$horasDisponibles[]=array(
						'estimado'=>$Horas[$j],
						'hora'=>$j,
						'chequeado'=>$chequeado,
						'fecha'=>$fecha,
						'mostrar'=>$mostra
					);
					$j++;
				}

				$tiempos[]=array(
					'encabezado'=>$fecha,
					'horas'=>$horasDisponibles
				);				

			}
			
			if ($k==6) {				
				break;
			}
		}

		//return $tiempos;
		$semana=array('Lun','Mar','Mie','Jue','Vie','Sab','Dom');
		return View::make('pasos_para_pago/tiempos',array('listaTiempos'=>$tiempos,'semana'=>$semana));

	}

	public function SeleccionarTiempo(){
		$fecha=Input::get('fecha');
		$hora=Input::get('hora');
		Session::put('hora',$hora);
		Session::put('fecha', $fecha);
	}


}