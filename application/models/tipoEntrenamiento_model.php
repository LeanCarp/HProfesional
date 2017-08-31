<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tipoEntrenamiento_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearTipoEntrenamiento($data){
		$this->load->database();
		$this->db->insert('tipoentrenamiento', $data);
	}

	function eliminarTipoEntrenamiento($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('tipoentrenamiento');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('tipoentrenamiento');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('tipoentrenamiento');
		return $query->result();
	}



}



?>