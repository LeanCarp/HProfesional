<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ReporteGrafico extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}

	#or !$this->acl->tienePermisoAcceso('Aplicacion Web Natacion ')
	function index(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
			$this->load->model('reporteGrafico_model');
			$data=$this->reporteGrafico_model->cargar();
			$this->load->view('headers');
			$this->load->view('reporteGrafico', $data);
		}
	}
	public function Hacerlo(){
		
		$dni = $this->input->post('selectNadador');
		$estilo = $this->input->post('selectEstilo');
		$tamañoPileta = $this->input->post('selectTamañoPileta');
		$distancia = $this->input->post('selectDistancia');
		$fecha1 = $this->input->post('fecha1');
		$fecha2 = $this->input->post('fecha2');
		//devuleve los id de los resultados filtrados por dni y fecha
		//hacer el filtrado en la prueba y devolver los id para buscar en los resultados
		//hacer el filtrado con el nadador y devolver en los resultados
		$idResultados=$this->reporteGrafico_model->getDatosGrafica($dni,$estilo,$tamañoPileta,$distancia,$fecha1,$fecha2);	
		// Devuelve los tiempos parciales filtrado por los resultados
		//$data=$this->load->model->getTiemposParcial($idResultados);
		//$this->load->view('reporteGrafico',$data);

	}



public function a($DNI,$fecha1,$fecha2,$estilo,$tamañoPileta,$distancia){

	$this->load->model("reporteGrafico_model","rept");
	var_dump($this->rept->lala($DNI,$fecha1,$fecha2,$estilo,$tamañoPileta,$distancia));
}
}