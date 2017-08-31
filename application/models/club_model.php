<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class club_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearClub($data){
		$this->load->database();
		$this->db->insert('club', $data);
	}

	function eliminarClub($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('club');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('club');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('club');
		return $query->result();
	}



}



?>