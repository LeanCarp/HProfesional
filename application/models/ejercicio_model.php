<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ejercicio_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearEjercicio($data){
		$this->load->database();
		$this->db->insert('ejercicio', $data);
	}

	function eliminarEjercicio($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('ejercicio');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('ejercicio');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('ejercicio');
		return $query->result();
	}



}



?>