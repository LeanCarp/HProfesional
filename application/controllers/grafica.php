<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafica extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		$this->load->model('nadador_model');
	}
	
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
        
            //KENDO UI    
	    	$output = [];
            $output['css_files'][] = base_url().'assets/css/kendo.common.min.css';
            $output['css_files'][] = base_url().'assets/css/kendo.default.min.css"';
            $output['css_files'][] = base_url().'assets/css/kendo.default.mobile.min.css';
	    	$output['js_files'][] = base_url().'assets/js/kendo.js';


	    	$this->load->view('headers', $output);
	    	$this->load->view('grafica', $output);
	    }
	}

	public function obtenerResultados()
    {
		//$this->load->model('entrenamiento_model');
		
		$this->load->model('grafica_model');

		$fromHere= new DateTime('2016-11-20');
		$toHere= new DateTime('2019-11-29');
		$distancia=100;
		$tamañoPileta=25;
		$id=38570363;
		$events = $this->grafica_model->obtenerResultados($fromHere, $toHere,$id,$distancia,$tamañoPileta);



		$datos=$this->InicializarArray((int)$distancia/(int)$tamañoPileta,(int)$tamañoPileta);
		

		$resultado=0;
		$parcial=0;
		$numeroResultado=0;

		for ($i = 0; $i < count($events); $i++)
		{		


			if ($resultado !=$events[$i]->ResultadoID)
			{
				
				$resultado=$events[$i]->ResultadoID;
				$parcial=1;
				$datos['categoriasMetros'][$numeroResultado]["name"]=$parcial. ": " . $events[$i]->Fecha;
				$numeroResultado++;
				
			}
			else
			{				
				$parcial++;				
			}	

			$Tiempo=$this->timeToInteger($events[$i]->Tiempo);		
            $datos['datosParciales'][$parcial-1]["Resultado".$numeroResultado]=$Tiempo;

		}
				
        echo json_encode($datos);
        exit();
	}
	

	public function timeToInteger($Tiempo)
	{
		return (int)substr($Tiempo,0, 2) *60 + (int)substr($Tiempo,3,2)+ 0.01* (double)substr($Tiempo,6, 2);
	}


	public function InicializarArray($cantidadParciales,$tamañoPileta)
	{
		$ar=[];
		$ar['titulo']="Probando Graficas";
		for ($i = 1; $i <= $cantidadParciales; $i++)
		{

			$ar['datosParciales'][] =array(
				"metros" => $i * $tamañoPileta
			);
			$ar['categoriasMetros'][] =array(
				"field" => "Resultado".$i,
				"categoryField"=> "metros",
				//"name" => "Fecha ".$i
			);
			

		}
		return $ar;

	}
}