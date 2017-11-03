<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class entrenamiento_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearEntrenamiento($data){
		$this->load->database();
		$this->db->insert('entrenamiento', $data);
	}

	function eliminarEntrenamiento($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('entrenamiento');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('entrenamiento');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('entrenamiento');
		return $query;
	}



}



?>