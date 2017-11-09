<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class club extends CI_Controller {
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
			$crud = new grocery_CRUD();
			$crud->set_language('spanish');
			$crud->set_table('club');
			$crud->columns('Nombre', 'localidadID');
            $crud->fields('Nombre', 'localidadID');
            
            $crud->set_relation('localidadID','localidad','Ciudad');
            $crud->display_as('localidadID','Localidad');

			$crud->unset_export();
			$crud->unset_print();

			/* Generamos la tabla */
	    	$output = $crud->render();
			$this->load->view('headersConfiguracion');
			$this->load->view('club', $output);
		}
	}

}