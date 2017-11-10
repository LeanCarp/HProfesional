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
		$this->load->model('nadador_model');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
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
	}

	function activos()
	{
		$this->load->model('nadador_model');
		return $this->nadador_model->getAllActivos();
	}

}
