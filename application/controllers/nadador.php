<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nadador extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		$this->load->model('nadador_model');
	}

	function index(){

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
	        {
			/*$this->load->view('headers');
			$result = $this->nadador_model->getAll();
			return $result;*/
			/*foreach ($result as $nadador)
			{
				echo $nadador->DNI;
			}*/
			$crud = new grocery_CRUD();
			$crud->set_language('spanish');
			$crud->set_table('nadador');
			$crud->columns('DNI', 'Apellido', 'Nombre', 'Sexo');
			$crud->fields('DNI', 'Apellido', 'Nombre', 'FechaNacimiento','Sexo');
			$crud->field_type('Sexo','true_false',
	       						 array('1' => 'Masculino', '0' => 'Femenino'));
			//$crud->unset_add();
			//$crud->unset_delete();
			//$crud->unset_read();
			$crud->unset_edit_fields('DNI');
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_add();
			//$crud->unset_operations();



			/* Generamos la tabla */
	    	$output = (array)$crud->render();
			//Se carga el titulo a la vista.
			$output['titulo']='Nadadores';
			$this->load->view('headers');
			$this->load->view('gestion', $output);
	    }
	}


}