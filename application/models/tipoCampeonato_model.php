<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tipoCampeonato_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearTipoCampeonato($data){
		$this->load->database();
		$this->db->insert('tipocampeonato', $data);
	}

	function eliminarTipoCampeonato($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('tipocampeonato');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('tipocampeonato');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('tipocampeonato');
		return $query->result();
	}



}



?>