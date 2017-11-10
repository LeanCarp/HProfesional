<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tamanoPileta_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearTamañoPileta($data){
		$this->load->database();
		$this->db->insert('tamañopileta', $data);
	}

	function eliminarTamañoPileta($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('tamañopileta');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('tamañopileta');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query;
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('tamañopileta');
		return $query;
	}



}



?>