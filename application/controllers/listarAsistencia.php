<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListarAsistencia extends CI_Controller {
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
			$crud->set_table('asistencia');
			$crud->set_subject('asistencia');
			$crud->columns('Fecha', 'NadadorID');
			$crud->fields('Fecha', 'NadadorID');
			$crud->set_relation('NadadorID', 'nadador', '{Nombre}');

			$output = $crud->render();

			$this->load->view('headers');
			$this->load->view('listarAsistencia', $output);
		}
	}

	function hacerlo(){
		$turno = $this->input->post('selectTurno');
		$fecha = $this->input->post('fecha');

		$crud = new grocery_CRUD();
		$crud->set_language('spanish');
		$crud->set_table('asistencia');
		$crud->set_subject('asistencia');
		$crud->columns('Fecha', 'NadadorID');
		$crud->fields('Fecha', 'NadadorID');
		$crud->set_relation('NadadorID', 'nadador', '{Nombre}');
		$crud->where('Fecha', $fecha);
		$crud->where('Mañana', $turno);

		$output = $crud->render();

		$this->load->view('headers');
		$this->load->view('listarAsistencia', $output);
	}

}