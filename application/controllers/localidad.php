<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class localidad extends CI_Controller {
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
	}

	function index(){
		
		$crud = new grocery_CRUD();
		$crud->set_language('spanish');
		$crud->set_table('localidad');
		$crud->columns('Ciudad');
		$crud->fields('Ciudad');
		$crud->set_subject('Localidad');
		
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_read();

		/* Generamos la tabla */
		$output = (array)$crud->render();
		//Se carga el titulo a la vista.
		$output['titulo']="Localidades";


		$this->load->view('headersConfiguracion');
		$this->load->view('gestion', $output);
		
	}

}