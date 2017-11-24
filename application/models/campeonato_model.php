<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class campeonato_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearCampeonato($data){
		$this->load->database();
		$this->db->insert('campeonato', $data);
	}

	function eliminarCampeonato($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('campeonato');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('campeonato');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('campeonato');
		return $query;
	}


	public function getNombre($id)
	{
		$this->load->database();
		$this->db->select('nombre');
		$this->db->from('campeonato');
		$this->db->where('campeonato.ID',$id);
		$query = $this->db->get(); 
		return $query->result()[0]->nombre;

	}

}



?>