<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class localidad_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearLocalidad($data){
		$this->load->database();
		$this->db->insert('localidad', $data);
	}

	function eliminarLocalidad($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('localidad');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('localidad');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('localidad');
		return $query->result();
	}



}



?>