<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Estilo extends CI_Controller {
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
		$crud->set_table('estilo');
		$crud->columns('Nombre','Entrenamiento');
		$crud->fields('Nombre', 'Entrenamiento');

		$crud->display_as('Entrenamiento','Tipo');

		$crud->field_type('Entrenamiento','true_false',
								array('1' => 'Oficial', '0' => 'Entrenamiento'));
		//$crud->unset_add();
		//$crud->unset_delete();
		$crud->unset_read();
		//$crud->unset_edit_fields('DNI');
		$crud->unset_export();
		$crud->unset_print();
		//$crud->set_relation('TipoEntrenamientoID','tipoEntrenamiento','ID');
		//$crud->unset_add();
		//$crud->unset_operations();
		$crud->set_subject('Estilo');

		/* Generamos la tabla */
		$output = (array)$crud->render();
		//Se carga el titulo a la vista.
		$output['titulo']="Estilos";


		$this->load->view('headersConfiguracion');
		$this->load->view('gestion', $output);
		
	}

}