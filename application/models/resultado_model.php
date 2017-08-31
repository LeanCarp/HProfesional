<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resultado_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearResultado($data){
		$this->load->database();
		$this->db->insert('resultado', $data);
	}

	function eliminarResultado($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('resultado');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('resultado');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('resultado');
		return $query->result();
	}



}



?>