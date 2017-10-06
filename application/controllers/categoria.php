<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categoria extends CI_Controller {
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
			$crud->set_table('categoria');
			$crud->columns('Nombre', 'EdadMinima', 'EdadMaxima');
			$crud->fields('Nombre','EdadMinima', 'EdadMaxima');
			$crud->display_as('EdadMinima','Edad Mínima');
			$crud->display_as('EdadMaxima','Edad Máxima');
			$crud->field_type('EdadMinima','dropdown',
									array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25'));
			$crud->field_type('EdadMaxima','dropdown',
									array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25'));
			//$crud->unset_add();
			//$crud->unset_delete();
			//$crud->unset_read();
			//$crud->unset_edit_fields('DNI');
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_add();
			//$crud->unset_operations();


			/* Generamos la tabla */
	    	$output = $crud->render();
			$this->load->view('headersConfiguracion');
			$this->load->view('categoria', $output);
		}
	}

}