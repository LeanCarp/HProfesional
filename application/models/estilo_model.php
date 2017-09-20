<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class estilo_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearEstilo($data){
		$this->load->database();
		$this->db->insert('estilo', $data);
	}

	function eliminarEstilo($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('estilo');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('estilo');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('estilo');
		return $query->result();
	}



}



?>