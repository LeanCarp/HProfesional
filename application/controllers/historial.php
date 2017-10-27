<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class historial extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}


	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
			
	    	$output = [];

			$output['css_files'][] = base_url().'assets/fullcalendar.min.css';
	    	$output['js_files'][] = base_url().'assets/jquery.min.js';
          	$output['js_files'][] = base_url().'assets/moment-with-locales.min.js';	
			$output['js_files'][] = base_url().'assets/fullcalendar.min.js';
			$output['js_files'][] = base_url().'assets/fullcalendar-locale-es.js';
			$output['js_files'][] = base_url().'assets/inicializarcalendar.js';

	    	$this->load->view('headers', $output);
	    	$this->load->view('historial', $output);
	    }
	}


	public function get_events()
    {
        $this->load->model('entrenamiento_model');

		// Our Start and End Dates
        $start = $this->input->get("start");
        $end = $this->input->get("end");
        
        $startdt = new DateTime('now'); // setup a local datetime
        $startdt->setTimestamp($start); // Set the date based on timestamp
        $start_format = $startdt->format('Y-m-d H:i:s');
   
        $enddt = new DateTime('now'); // setup a local datetime
        $enddt->setTimestamp($end); // Set the date based on timestamp
        $end_format = $enddt->format('Y-m-d H:i:s');
        
        $events = $this->entrenamiento_model->getEntrenamientosUsuario(38570363);
        $data_events = array();


        foreach($events as $r) {
            
                     $data_events[] = array(  
                        "id" => $r->EntrenamientoID,                     
                         "title" => $r->nombre,
                         //"description" => $r->description,
                         "end" => $r->Fecha,
                         "start" => $r->Fecha,
                         "color"=>$r->color
                     );
                 }   
        echo json_encode(array("events" => $data_events));
        exit();
    }
    
}