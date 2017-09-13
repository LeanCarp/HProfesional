<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function Index(){
	$data['titulo'] = 'Aplicacion Web Natacion ';

	this->load->view(Plantilla/Encabezado,$data);
	this->load->view(Home/Index);
	this->load->view(Plantilla/PieDePag);
	
}
}
