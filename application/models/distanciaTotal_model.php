<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class distanciaTotal_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearDistanciaTotal($data){
		$this->load->database();
		$this->db->insert('distanciatotal', $data);
	}

	function eliminarDistanciaTotal($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('distanciatotal');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('distanciatotal');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('distanciatotal');
		return $query->result();
	}



}



?>