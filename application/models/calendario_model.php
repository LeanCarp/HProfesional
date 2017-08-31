<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class calendario_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearCalendario($data){
		$this->load->database();
		$this->db->insert('calendario', $data);
	}

	function eliminarCalendario($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('calendario');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('calendario');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('calendario');
		return $query->result();
	}



}



?>