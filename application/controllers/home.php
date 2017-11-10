<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		$this->load->library(array('ion_auth','grocery_crud'));

	}

#

	public function Index(){
		$data['titulo'] = 'Aplicacion Web Natacion ';
		if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else
        {
	        this->load->view(Plantilla/Encabezado,$data);
			this->load->view(Home/Index);
			this->load->view(Plantilla/PieDePag);
        }

		
	}
}
