<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Asistencia extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		$this->load->model('nadador_model');
		$this->load->model('entrenamiento_model');
		$this->load->model('asistencia_model');
		$this->load->model('lineaAsistencia_model');
	}

	function index(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
			$data['nadadores'] = $this->nadador_model->getAll();
			$data['entrenamientos'] = $this->entrenamiento_model->getAll();
			
			$this->load->view('headers');
			$this->load->view('asistencia', $data);
		}
	}

	public function Hacerlo(){
		
		$turno = $this->input->post('selectTurno');
		$entrenamiento = $this->input->post('selectEntrenamiento');
		$fecha = $this->input->post('fecha');
		$nadadores = $this->input->post('checkeds');


		$data = array('Mañana' => $turno, 'Fecha' => $fecha, 'EntrenamientoID' => 11, 'CampeonatoID' => null);
		$asistencia_id = $this->asistencia_model->insertarAsistencia($data);

 		foreach ($nadadores as $nadador)
		{
			$data = array('AsistenciaID' => $asistencia_id,'NadadorID' => $nadador);
			$insert_id = $this->lineaAsistencia_model->insertarLineaAsistencia($data);
		}
		
		$data['mensaje'] = "Asistencia guardada correctamente.";

		$this->load->view('headers');
		$this->load->view('mensaje', $data);
	}

	function validarAsistencia()
	{
		$turno = $this->input->post('turno');
		$fecha = date($this->input->post('fecha'));
		//$nadadores = $this->input->post('nadadores');

		/* $fecha = date("2010-12-13");
		$turno = 0; */

		$this->db->select('*');
		$this->db->from('asistencia');
		$this->db->where('Fecha', $fecha);
		$this->db->where('Mañana', $turno);
		$query = $this->db->get();
		$asistencia = $query->result();
		$data['valido'] = 'true';

		if (count($asistencia) == 0)
		{
			$data['valido'] = 'false';
		}

		echo json_encode($data);
	}
}