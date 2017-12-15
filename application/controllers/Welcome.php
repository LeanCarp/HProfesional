<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		$this->load->model('nadador_model');
	}
	
	public function index()
	{
		$output = [];
		$output['activos']=$this->activos();
		$output['css_files'][] = base_url().'assets/fullcalendar.min.css';
		$output['js_files'][] = base_url().'assets/jquery.min.js';
		$output['js_files'][] = base_url().'assets/moment-with-locales.min.js';	
		$output['js_files'][] = base_url().'assets/fullcalendar.min.js';
		$output['js_files'][] = base_url().'assets/fullcalendar-locale-es.js';
		$output['js_files'][] = base_url().'assets/inicializarcalendar.js';

		$this->load->view('headers', $output);
		$this->load->view('inicio', $output);
	    
	}

	function activos()
	{
		$this->load->model('nadador_model');
		return $this->nadador_model->getAllActivos();
	}

}
