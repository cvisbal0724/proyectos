<?php namespace App\Http\Controllers;

use App\models\Menus;
use App\models\PerfilModulos;
use App\models\Lideres;
use App\models\Concejales;
use App\models\Alcaldes;
use Auth;
use App\Enums\EnumPerfiles;
use App;
use PDF;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		try {
			
		
		$usuario=Auth::User();
		$perfilMod= PerfilModulos::where('id_perfil','=',$usuario->id_perfil)->get();
		$modulos=array();
		foreach ($perfilMod as $key => $item) {
			$modulos[$key]=$item->id_modulo;
		}

		$lista=Menus::whereIn('id_modulo',$modulos)->get();

		$menu=array();

	$i=-1;	
	foreach ($lista as $key => $row) {
		if ($row->id_padre==0) {
			$menu[]=array(
				'id'=>$row->id,
				'nombre'=>$row->nombre,
				'etiqueta'=>$row->etiqueta,
				'id_padre'=>$row->id_padre,
				'id_modulo'=>$row->id_modulo,
				'url'=>$row->url,
				'orden'=>$row->orden,
				'imagen'=>$row->imagen,
				'hijos'=>array());

			$i++;

		}
		
		foreach ($lista as $key2 => $row2) {

			if ($row->id==$row2->id_padre) {

				$hijo=array(
					'id'=>$row2->id,
					'nombre'=>$row2->nombre,
					'etiqueta'=>$row2->etiqueta,
					'id_padre'=>$row2->id_padre,
					'id_modulo'=>$row2->id_modulo,
					'url'=>$row2->url,
					'orden'=>$row2->orden,
					'imagen'=>$row2->imagen);

				$menu[$i]['hijos'][]=$hijo;
				
			}
		}
	}

		$foto='';

		if ($usuario->id_perfil==2) {
			$alcalde=Alcaldes::find($usuario->persona->id_alcalde);
			$foto=$alcalde->foto!='' && $alcalde->foto!=null ? 'app_cliente/fotos_alcalde/'.$alcalde->foto : '';			
		}
		elseif ($usuario->id_perfil==3) {
			$concejal=Concejales::where('id_persona','=',$usuario->id_persona)->first();
			$foto=$concejal->foto!='' && $concejal->foto!=null ? 'app_cliente/fotos_concejal/'.$concejal->foto : '';			
		}elseif ($usuario->id_perfil==4) {
			$lider=Lideres::where('id_persona','=',$usuario->id_persona)->first();
			$foto=$lider->foto!='' && $lider->foto!=null ? 'app_cliente/fotos_lider/'.$lider->foto : '';			
		}
	
		return view('inicio/home',array('menu'=>$menu,'nombre'=>$usuario->persona->nombre_completo(),'foto'=>$foto));

		} catch (Exception $e) {
			return $e;
		}
	}

	public function testpdf()
	{
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML('<h1>Test</h1>');
		return $pdf->stream('download.pdf');

		/*$pdf = PDF::loadView('pdf.invoice', $data);
		return $pdf->download('invoice.pdf');*/
	}


	public function invoice() 
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";

        $view =  \View::make('pdf.prueba', compact('data', 'date', 'invoice'))->render();

        /*$view2 =  \View::make('pdf.prueba', compact('data', 'date', 'invoice'))->render();

        $pages[]=$view ;
        $pages[]=$view2 ;*/

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->stream('invoice');

       /* $pdf = PDF::loadView('pdf.multipages', ['pages' => $pages]);

 return $pdf->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->stream('invoice');*/

    }

    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

    public function vista(){

    	$data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
    	return view('pdf/prueba',compact('data', 'date', 'invoice'));
    }

}
