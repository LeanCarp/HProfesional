<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profesor_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearProfesor($data){
		$this->load->database();
		$this->db->insert('profesor', $data);
	}

	function eliminarProfesor($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('profesor');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('profesor');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('profesor');
		return $query->result();
	}



}



?>