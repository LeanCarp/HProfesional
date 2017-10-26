<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Asistencia extends CI_Controller {
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
			$this->load->database();
			$this->db->select('DNI, Apellido, Nombre');
			$this->db->from('nadador');
			// $this->db->where('');
			$data['records2'] = $this->db->get();

        	$this->load->database();
			$this->db->select('ID, Nombre');
			$this->db->from('entrenamiento');
			// $this->db->where('');
			$data['records'] = $this->db->get();
			$this->load->view('headers');
			$this->load->view('asistencia', $data);
		}
	}

	public function Hacerlo(){
		
		$turno = $this->input->post('selectTurno');
		$entrenamiento = $this->input->post('selectEntrenamiento');
		$fecha = $this->input->post('fecha');
		$nadadores = $this->input->post('checkeds');

		/////// ESTO LE CORRESPONDE AL MODELLLLLL
		$this->load->database();

		$data = array('Mañana' => $turno, 'Fecha' => $fecha, 'EntrenamientoID' => $entrenamiento, 'CampeonatoID' => null);
		$this->db->insert('asistencia', $data);
		$insert_id = $this->db->insert_id();

 		foreach ($nadadores as $nadador)
		{
			$data = array('AsistenciaID' => $insert_id, 'NadadorID' => $nadador);
			$this->db->insert('lineaasistencia', $data);
		}
		/////////////////////////////////////////
		echo "lo hizo";
		//$this->index();
	}


// sirve para mostrar todo el contenido del vector.
	// var_dump($this->input->post());
		// die();

}