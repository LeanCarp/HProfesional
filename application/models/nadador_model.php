<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nadador_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearNadador($data){
		//$this->db->insert('cursos', array('nombreCurso'=>$data['nombre'], 'videosCurso'=>$data['videos']));
		$this->load->database();
		$this->db->insert('nadador', $data);
	}

	function eliminarNadador($id){
		$this->load->database();
		$this->db->where('DNI', $id);
		$this->db->delete('nadador');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('nadador');
		$this->db->where('DNI', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('nadador');
		return $query->result();
	}

	function getAllActivos(){
		$this->load->database();
		$this->db->where('activo', true);
		$query = $this->db->count_all_results('nadador');
		return $query;
	}


}



?>