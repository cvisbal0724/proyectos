<?php

class PasosPagoController extends BaseController {


	public function Checkout(){

		if (Session::has('usuario')) {
			return View::make('pasos_para_pago/paso1');
		}else{
			return View::make('inicio/login');
		}

	}


}