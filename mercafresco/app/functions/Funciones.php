<?php


/**
* 
*/
class  Funciones
{
	
	/**
	 * Resta entre dos fecha	 
	 *
	 * @return horas
	 */
	public static function RestarFechas($fecha1,$fecha2)
	{		
		$ts1 = strtotime($fecha1);
		$ts2 = strtotime($fecha2);
		$seconds_diff = $ts2 - $ts1;
		return $seconds_diff / ( 60 * 60);
	}

}