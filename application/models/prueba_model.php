<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class prueba_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearPrueba($data){
		$this->load->database();
		$this->db->insert('prueba', $data);
	}

	function eliminarPrueba($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('prueba');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('prueba');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query;
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('prueba');
		return $query->result();
	}

	function getPruebaEntrenamiento($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('prueba');
		$this->db->where('EntrenamientoID', $id);
		$query = $this->db->get();
		return $query;
	}

	function getPruebaCampeonato($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('prueba');
		$this->db->where('CampeonatoID', $id);
		$query = $this->db->get();
		return $query;
	}



}



?>