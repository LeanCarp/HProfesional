<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Campeonato extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}

	#or !$this->acl->tienePermisoAcceso('Aplicacion Web Natacion ')
	function index(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
			$crud = new grocery_CRUD();
			$crud->set_language('spanish');
			$crud->set_table('campeonato');
			$crud->set_subject('campeonato');
			$crud->columns('Fecha', 'Nombre');
			$crud->fields('Fecha', 'Nombre', 'TipoCampeonatoID');
			//$crud->unset_add();
			//$crud->unset_delete();
			//$crud->unset_read();
			//$crud->unset_edit_fields('DNI');
			$crud->unset_export();
			$crud->unset_print();
			$crud->set_relation('TipoCampeonatoID','tipocampeonato','Tipo');
			$crud->display_as('TipoCampeonatoID','Tipo');

			//$crud->unset_add();
			//$crud->unset_operations();


			/* Generamos la tabla */
	    	$output = $crud->render();
			$this->load->view('headers');
			$this->load->view('campeonato', $output);
		}
	}

}