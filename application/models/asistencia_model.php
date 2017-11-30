<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class asistencia_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		$this->load->database();
	}

	function insertarAsistencia($data){
		$this->db->insert('asistencia', $data);
		return $this->db->insert_id();
	}

	function eliminarPrueba($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('asistencia');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('asistencia');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('asistencia');
		return $query->result();
	}

	function getAsistenciaPorFechaYTurno($fecha, $turno){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('asistencia');
		$this->db->where('Fecha', $fecha);
		$this->db->where('Mañana', $turno);
		$query = $this->db->get();
		return $query->result();
	}



}



?>