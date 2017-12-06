<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Entrenamiento extends CI_Controller {
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
			$crud->set_table('entrenamiento');
			$crud->columns('inicio','fin', 'nombre');
			$crud->fields('inicio','fin', 'nombre', 'TipoEntrenamientoID','color');
			
			//$nombreEntrenamiento=$crud->get_edit_field_value('Nombre');

			//$crud->add_action('<+>', '+','pruebaEntrenamiento/index');
			$crud->add_action('Pruebas', base_url().'assets/imgs/pruebaIcon.png', 'pruebaEntrenamiento/index');

			$crud->set_subject('Nombre');
			//$crud->unset_add();
			//$crud->unset_delete();
			//$crud->unset_read();
			//$crud->unset_edit_fields('DNI');
			$crud->set_relation('TipoEntrenamientoID','tipoentrenamiento','{nombre}');
			$crud->display_as('TipoEntrenamientoID','Tipo');
			$crud->display_as('inicio','Fecha de Inicio');
			$crud->display_as('fin','Fecha de Fin');
			//$crud->field_type('color','color_pciker');
			$crud->field_type('color','dropdown',
										array('blue' => 'azul', 'pink' => 'rosado','yellow' => 'amarillo' , 'black' => 'negro'));



			/* Generamos la tabla */
	    	$output = (array)$crud->render();
			//Se carga el titulo a la vista.
			$output['titulo']='Entrenamientos';
			$this->load->view('headers');
			$this->load->view('gestion', $output);
		}
	}


}