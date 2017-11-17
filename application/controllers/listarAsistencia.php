<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ListarAsistencia extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->model("asistencia_model");
		$this->load->model("nadador_model");
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

			$this->load->view('headers');
			$this->load->view('listarAsistencia');
		}
	}

	function probador() {
		$fecha = $this->input->post("fecha");
		$turno = $this->input->post("turno");
		if ($fecha == null)
		{
			echo '<li class="list-group-item li-contenido">Seleccione una fecha y un turno</li>';
		}
		else
		{
			$data = $this->asistencia_model->getAsistenciaPorFechaYTurno($fecha, $turno);

			if (empty($data))
			{
				echo '<li class="list-group-item li-contenido">No se registraron asistencias</li>';
			}
			else
			{
				foreach ($data as $campo)
				{
					$this->load->database();
					$this->db->from('lineaasistencia');
					$this->db->where('AsistenciaID', $campo->ID);
					$query = $this->db->get();
					$query = $query->result();
	
					if (empty($query))
					{
						echo '<li class="list-group-item li-contenido">No se registraron asistencias</li>';
					}
					else
					{
						foreach($query as $row){
							$query2 = $this->nadador_model->getByID($row->NadadorID);
							echo '<li class="list-group-item li-contenido">'. $row->NadadorID .' | '. $query2[0]->Apellido .', '. $query2[0]->Nombre .' </li>';
						}
					}
				}
			}
		}
	}

	function hacerlo(){
		$turno = $this->input->post('selectTurno');
		$fecha = $this->input->post('fecha');

		//$idAsistencia = 

		$crud = new grocery_CRUD();
		$crud->set_language('spanish');
		$crud->set_table('asistencia');
		$crud->set_subject('asistencia');
		$crud->columns('Fecha', 'NadadorID');
		$crud->fields('Fecha', 'NadadorID');
		$crud->set_relation('NadadorID', 'nadador', '{Nombre}');
		/* $crud->where('Fecha', $fecha);
		$crud->where('Mañana', $turno); */

		$output = $crud->render();

		$this->load->view('headers');
		$this->load->view('listarAsistencia', $output);
	}

}