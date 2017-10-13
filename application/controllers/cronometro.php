<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cronometro extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}

	function index(){
    	if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
	        $this->load->database();
			$this->db->select('DNI, Apellido, Nombre');
			$this->db->from('nadador');
			$data['nadadores'] = $this->db->get();

	    	$this->load->view('headers');
	    	$this->load->view('cronometro', $data);
	    }
	}

}