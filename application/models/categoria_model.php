<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class categoria_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearCategoria($data){
		$this->load->database();
		$this->db->insert('categoria', $data);
	}

	function eliminarCategoria($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('categoria');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('categoria');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('categoria');
		return $query;
	}



}



?>